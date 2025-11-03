@extends('layouts.visitor')

@section('title')

@section('content')
    @include('visitor.sections.hero')

    <main id="main">
        @include('visitor.sections.about')
        @include('visitor.sections.stats')
        @include('visitor.sections.services')
        @include('visitor.sections.testimony')
        @include('visitor.sections.gallery')
        @include('visitor.sections.contact')
    </main>
@endsection
