@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <h1>Posts do mês {{ translateMonthDate($month) }}</h1>
            @foreach($posts as $post)
                <div class="col-12" style="margin: 50px;">
                    <a href="{{ route('post', $post->id) }}"><h2>{{ $post->title }}</h2></a>
                    <h5>{{ $post->subtitle }}</h5>
                    <h6>Escrito por {{ $post->user->name }} em {{ date('d/m/Y', strtotime($post->creation_date)) }}</h6>
                    <img class="img-fluid" src="{{ asset('storage/' . $post->image) }}" width="400" height="400">
                    <p>{{ $post->abstract }}</p>
                </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {!! $posts->links() !!}
    </div>
</div>
@endsection
