<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.city.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Form create article
        return view('admin.city.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validated([
            'province' => 'required|string|max:255',
            'city_name' => 'required|string|max:255|unique:cities,city_name',
        ]);

        City::create($validated);

        return redirect()->route('admin.city.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $city = City::findOrFail($id);

        return view('admin.city.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validated([
            'province' => 'required|string|max:255',
            'city_name' => 'required|string|max:255|unique:cities,city_name,',
        ]);

        $city = City::findOrfail($id);

        $city->update($validated);

        return redirect()->route('admin.city.index')->with('success', 'Kota berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        //
    }
}
