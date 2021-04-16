@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($posts as $post)
            <div class="col-12">
                <h1>{{ $post->title }}</h1>
                <h4>{{ $post->subtitle }}</h4>
                <h6>Escrito por {{ $post->user->name }} em {{ $post->creation_date }}</h6>
                <h6>Categoria: {{ $post->category->name }}</h6>
                <img class="img-fluid" src="{{ asset('storage/' . $post->image) }}" width="400" height="400">
                <p>{{ $post->text }}</p>
                <p>{{ $post->abstract }}</p>
            </div>
        @endforeach  
    </div>
</div>
@endsection
