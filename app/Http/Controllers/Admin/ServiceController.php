<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.services.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'thumbnail'   => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'images.*'    => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Upload thumbnail
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('services/thumbnails', 'public');
        }

        // Buat service
        $service = Service::create($validated);

        // Upload multiple gallery images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $service->images()->create([
                    'image_path' => $image->store('services/gallerytools', 'public')
                ]);
            }
        }

        return redirect()->route('admin.services.index')
            ->with('success', 'Service berhasil ditambahkan!');
    }

    public function getData(Request $request)
    {
        $query = Service::select('services.*')->orderBy('created_at', 'desc');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('description', function ($row) {
                // Ambil text saja
                $desc = strip_tags($row->description);

                if (!$desc || trim($desc) === '') {
                    return '<div class="description-truncate">-</div>';
                }

                // Batasi panjang string
                $limit = 100;
                if (mb_strlen($desc) > $limit) {
                    $desc = mb_substr($desc, 0, $limit) . '...';
                }

                // Bungkus dengan div untuk CSS
                return '<div class="description-truncate" title="' . e($desc) . '">' . e($desc) . '</div>';
            })


            ->addColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at->format('d M Y') : '-';
            })

            ->addColumn('actions', function ($row) {
                $previewBtn = '<button type="button" class="btn btn-info btn-sm text-white btn-preview"
                                data-id="' . $row->id . '">
                                <i class="bi bi-eye"></i>
                            </button>';

                $editUrl = route('admin.services.edit', $row->id);
                $deleteUrl = route('admin.services.destroy', $row->id);

                return $previewBtn . ' 
                <a href="' . $editUrl . '" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <form action="' . $deleteUrl . '" method="POST" class="d-inline form-delete">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>';
            })
            ->addColumn('thumbnail', function ($row) {
                if ($row->thumbnail) {
                    return '<img src="' . asset('storage/' . $row->thumbnail) . '" alt="Thumbnail" width="50" class="rounded">';
                }
                return '-';
            })
            ->rawColumns(['description', 'thumbnail', 'actions'])
            ->orderColumn('created_at', '-created_at $1')
            ->make(true);
    }


    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    public function preview(Service $service)
    {
        $service->load('images');

        return response()->json([
            'id'          => $service->id,
            'name'        => $service->name,
            'description' => $service->description,
            'thumbnail'   => $service->thumbnail ? asset('storage/' . $service->thumbnail) : null,
            'images'      => $service->images->map(function ($img) {
                return [
                    'id'         => $img->id,
                    'image_path' => asset('storage/' . $img->image_path), // full URL biar tampil
                ];
            }),
            'created_at'  => $service->created_at?->format('d M Y H:i'),
            'updated_at'  => $service->updated_at?->format('d M Y H:i'),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        // Validasi
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'images.*'    => 'image|mimes:jpg,jpeg,png|max:2048',
            'remove_images' => 'nullable|array' // array of service_image ids untuk dihapus
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Replace thumbnail jika ada upload baru
        if ($request->hasFile('thumbnail')) {
            // Hapus file lama jika ada
            if ($service->thumbnail && Storage::disk('public')->exists($service->thumbnail)) {
                Storage::disk('public')->delete($service->thumbnail);
            }

            $validated['thumbnail'] = $request->file('thumbnail')->store('services/thumbnails', 'public');
        }

        // Update name & description
        $service->update($validated);

        // Hapus gallery images yang dipilih
        if (!empty($validated['remove_images'])) {
            foreach ($validated['remove_images'] as $imageId) {
                $img = $service->images()->find($imageId);
                if ($img) {
                    if (Storage::disk('public')->exists($img->image_path)) {
                        Storage::disk('public')->delete($img->image_path);
                    }
                    $img->delete();
                }
            }
        }

        // Upload gallery images baru
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $service->images()->create([
                    'image_path' => $image->store('services/gallery', 'public')
                ]);
            }
        }

        return redirect()->route('admin.services.index')
            ->with('success', 'Service berhasil diupdate!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service berhasil dihapus!');
    }
}
