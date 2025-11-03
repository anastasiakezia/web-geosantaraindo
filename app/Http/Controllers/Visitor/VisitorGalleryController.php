<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\VisitorGallery;
use Illuminate\Http\Request;
use App\Models\GalleryProject;
use App\Models\Service;

class VisitorGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = GalleryProject::with(['city', 'service'])->get();

        // Mengambil semua project gallery beserta relasinya
        $galleryItems = GalleryProject::with(['city', 'service', 'images'])->paginate(12);

        // Ambil semua layanan dan urutkan abjad (A-Z)
        $services = Service::select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        // Ambil lokasi unik (province + city_name) dan urutkan abjad berdasarkan provinsi lalu kota
        $locations = GalleryProject::with('city')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->city_id,
                    'province' => $item->city->province ?? '-',
                    'city_name' => $item->city->city_name ?? '-'
                ];
            })
            ->unique('id')
            ->sort(function ($a, $b) {
                $provCompare = strcmp($a['province'], $b['province']);
                return $provCompare === 0
                    ? strcmp($a['city_name'], $b['city_name'])
                    : $provCompare;
            })
            ->values();

        return view('visitor.galleries.index', compact('locations', 'galleryItems', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $galleryItem = GalleryProject::with(['city', 'service', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('visitor.galleries.show', compact('galleryItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisitorGallery $visitorGallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VisitorGallery $visitorGallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisitorGallery $visitorGallery)
    {
        //
    }
}
