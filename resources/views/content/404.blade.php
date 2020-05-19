@extends('master')

@section('title', 'Error 404 | Astrotomic')

@section('content')
    <hero>
        <div class="container mx-auto px-4 py-32 text-center">
            <h2 class="text-6xl text-white font-bold">
                <icon icon="fa-satellite" />
                Error
                <span class="opacity-75">404</span>
            </h2>
            <h3 class="text-5xl text-white">Lost in Space</h3>

            <div class="flex justify-center mt-16">
                <a href="{!! url('/') !!}" class="btn">back to earth</a>
            </div>
        </div>
    </hero>

    <copyright/>
@endsection
