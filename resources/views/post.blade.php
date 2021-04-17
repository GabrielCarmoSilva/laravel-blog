@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="col-12" style="margin: 50px;">
                <h1>{{ $post->title }}</h1>
                <h4>{{ $post->subtitle }}</h4>
                <h6>Escrito por {{ $post->user->name }} em {{ date('d/m/Y', strtotime($post->creation_date)) }}</h6>
                <h6>Categoria: {{ $post->category->name }}</h6>
                <img class="img-fluid" src="{{ asset('storage/' . $post->image) }}">
                <p style="font-size: 16px;">{{ $post->text }}</p>
                <p>{{ $post->abstract }}</p>
            </div>
        </div>
    </div>
</div>
@endsection