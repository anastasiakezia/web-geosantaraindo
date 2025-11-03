<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryProject;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Service;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hitung jumlah data
        $articlesCount = Article::where('type', 'article')->count();
        $csrCount = Article::where('type', 'csr')->count();
        $servicesCount = Service::count();
        $projectsCount = GalleryProject::count();

        // Artikel per bulan untuk grafik
        $articlesPerMonth = Article::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Biar semua bulan ada datanya (0 kalau kosong)
        $months = range(1, 12);
        $chartData = [];
        foreach ($months as $m) {
            $chartData[] = $articlesPerMonth[$m] ?? 0;
        }

        return view('admin.dashboard', compact(
            'articlesCount',
            'csrCount',
            'servicesCount',
            'projectsCount',
            'chartData'
        ));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
