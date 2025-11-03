<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VisitorServiceController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data sesuai pencarian (kalau ada)
        $services = Service::with('images')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Jika request AJAX (fetch live search)
        if ($request->ajax()) {
            $html = '';

            if ($services->count() > 0) {
                foreach ($services as $service) {
                    $html .= '
                        <div class="col-md-4">
                            <a href="' . route('visitor.services.show', $service->slug) . '" class="text-decoration-none text-dark">
                                <div class="service-card text-center h-100"
                                    style="border-radius:16px; background:#fff; overflow:hidden;
                                    box-shadow:0 4px 12px rgba(0,0,0,0.12);
                                    transition:all .25s ease-in-out;"
                                    onmouseover="this.style.transform=\'translateY(-6px)\'; this.style.boxShadow=\'0 8px 18px rgba(0,0,0,0.18)\';"
                                    onmouseout="this.style.transform=\'\'; this.style.boxShadow=\'0 4px 12px rgba(0,0,0,0.12)\';">

                                    <div style="width:100%; height:230px; overflow:hidden; border-radius:16px 16px 0 0;">
                                        <img src="' . asset('storage/' . $service->thumbnail) . '" alt="' . e($service->name) . '"
                                            style="width:100%; height:100%; object-fit:cover;">
                                    </div>

                                    <div class="p-3">
                                        <h3 style="font-size:1rem; font-weight:600; line-height:1.3;">' . e($service->name) . '</h3>
                                        <p style="font-size:0.9rem; color:#555; line-height:1.4;">' . e(Str::limit(strip_tags($service->description), 100)) . '</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    ';
                }
            } else {
                $html = '
                    <div class="text-center py-5 w-100">
                        <div style="font-size:3rem;">😕</div>
                        <p class="text-black fw-800 mt-2">Layanan tidak ditemukan. Coba kata kunci lain ya!</p>
                        <a href="' . route('visitor.services.index') . '" class="btn btn-outline-primary mt-3">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                ';
            }

            return response()->json(['html' => $html]);
        }

        // Jika bukan AJAX, tampilkan halaman utama
        return view('visitor.services.index', compact('services'));
    }

    public function show($slug)
    {
        $service = Service::with('images')->where('slug', $slug)->firstOrFail();

        $services = Service::with('images')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('visitor.services.show', compact('service', 'services'));
    }
}
