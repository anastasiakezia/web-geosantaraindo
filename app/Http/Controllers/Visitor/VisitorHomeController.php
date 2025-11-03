<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\VisitorHome;
use Illuminate\Http\Request;

class VisitorHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('visitor.sections.home');
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
    public function show(VisitorHome $visitorHome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisitorHome $visitorHome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VisitorHome $visitorHome)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisitorHome $visitorHome)
    {
        //
    }
}
