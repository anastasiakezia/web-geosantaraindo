<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryProject;
use App\Http\Requests\StoreGalleryProjectRequest;
use App\Http\Requests\UpdateGalleryProjectRequest;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\City;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GalleryProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleryProjects = GalleryProject::with(['service', 'city'])->latest()->get();
        return view('admin.galleries.index', compact('galleryProjects'));
    }

    /**
     * Get data for DataTables (server-side)
     */
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $query = GalleryProject::with(['service', 'city'])->latest();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('service', fn($row) => $row->service->name ?? '-')
                ->addColumn('city', fn($row) => ($row->city->province ?? '-') . ' - ' . ($row->city->city_name ?? '-'))
                ->addColumn('created_at', fn($row) => $row->created_at->format('d M Y'))
                ->addColumn('actions', function ($row) {
                    return '
                        <a href="' . route('admin.galleries.show', $row->id) . '" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="' . route('admin.galleries.edit', $row->id) . '" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="' . route('admin.galleries.destroy', $row->id) . '" method="POST" class="d-inline form-delete">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return abort(400);
    }

    public function create()
    {
        $services = Service::all();
        $provinces = City::select('province')->distinct()->pluck('province');
        return view('admin.galleries.create', compact('services', 'provinces'));
    }

    public function store(StoreGalleryProjectRequest $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'city_id' => 'required|exists:cities,id',
            'image_path.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $slugBase = Str::slug($request->project_name);
        $slug = $slugBase;
        $counter = 1;

        while (GalleryProject::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $counter++;
        }

        $project = GalleryProject::create([
            'project_name' => $request->project_name,
            'service_id' => $request->service_id,
            'city_id' => $request->city_id,
            'slug' => $slug,
        ]);

        if ($request->hasFile('image_path')) {
            foreach ($request->file('image_path') as $file) {
                $path = $file->store('gallery', 'public');
                $project->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery project successfully added.');
    }

    public function show(GalleryProject $galleryProject)
    {
        $galleryProject->load('service', 'city', 'images');
        return view('admin.galleries.show', compact('galleryProject'));
    }

    public function edit(GalleryProject $galleryProject)
    {
        $services = Service::all();
        $provinces = City::select('province')->distinct()->pluck('province');
        $galleryProject->load('images');
        return view('admin.galleries.edit', compact('galleryProject', 'services', 'provinces'));
    }

    public function update(UpdateGalleryProjectRequest $request, GalleryProject $galleryProject)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'city_id' => 'required|exists:cities,id',
            'image_path.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($galleryProject->project_name !== $request->project_name) {
            $slugBase = Str::slug($request->project_name);
            $slug = $slugBase;
            $counter = 1;
            while (GalleryProject::where('slug', $slug)->where('id', '!=', $galleryProject->id)->exists()) {
                $slug = $slugBase . '-' . $counter++;
            }
            $galleryProject->slug = $slug;
        }

        $galleryProject->update([
            'project_name' => $request->project_name,
            'service_id' => $request->service_id,
            'city_id' => $request->city_id,
        ]);

        if ($request->hasFile('image_path')) {
            foreach ($request->file('image_path') as $file) {
                $path = $file->store('gallery', 'public');
                $galleryProject->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery project successfully updated.');
    }

    public function destroy(GalleryProject $galleryProject)
    {
        foreach ($galleryProject->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        $galleryProject->images()->delete();
        $galleryProject->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery project successfully deleted.');
    }

    public function deleteImage($id)
    {
        $image = GalleryImage::findOrFail($id);

        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return response()->json(['success' => true]);
    }

    public function getCitiesByProvince($province)
    {
        $cities = City::where('province', $province)->get(['id', 'city_name']);
        return response()->json($cities);
    }
}
