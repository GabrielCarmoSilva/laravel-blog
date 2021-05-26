@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($carousel_posts as $post)
                        @if($loop->first)
                            <div class="carousel-item active">
                                <img style="opacity: 0.5; " height="400" class="d-block w-100" src="{{ asset('storage/' . $post->image) }}" alt="First slide">
                                <div class="carousel-caption d-none d-md-block" style="color: black;">
                                    <h5 class="font-weight-bold">{{ $post->title }}</h5>
                                    <p class="font-weight-bold">{{ $post->subtitle }}</p>
                                </div>
                            </div>
                        @else
                            <div class="carousel-item">
                                <img style="opacity: 0.5; " height="400" class="d-block w-100" src="{{ asset('storage/' . $post->image) }}" alt="First slide">
                                <div class="carousel-caption d-none d-md-block" style="color: black;">
                                    <h5 class="font-weight-bold">{{ $post->title }}</h5>
                                    <p class="font-weight-bold">{{ $post->subtitle }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="mt-4 row">
                <div class="col-md-8">
                    @foreach($posts as $post)
                        <div class="col-12" style="margin: 50px;">
                            <a href="{{ route('post', $post->id) }}"><h2>{{ $post->title }}</h2></a>
                            <h5>{{ $post->subtitle }}</h5>
                            <h6>Escrito por {{ $post->user->name }} em {{ date('d/m/Y', strtotime($post->creation_date)) }}</h6>
                            <h6>Categoria: {{ $post->category->name }}</h6>
                            <img class="img-fluid" src="{{ asset('storage/' . $post->image) }}" width="400" height="400">
                            <p>{{ $post->abstract }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <h4>Categorias</h4>
                    @foreach($categories as $category)
                        <a href="{{ route('postCategory', $category->id) }}"><p>{{ $category->name }}</p></a>
                    @endforeach
                    <br><br>
                    <h4>Arquivos</h4>
                    @for($i = 1; $i <= 12; $i++)
                        <a href="{{ route('postMonth', $i) }}"><p>{{ translateMonthDate($i) }}</p></a>
                    @endfor
                    <br><br>
                    <h4>Pesquisa</h4>
                    <div class="input-group">
                        <form method="post" action="{{ route('search') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-outline">
                                    <input name="search" type="search" id="form1" class="form-control" />
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>  
    </div>
    <div class="d-flex justify-content-center">
        {!! $posts->links() !!}
    </div>
    <div class="text-center alert alert-dismissible cookiealert" role="alert">
  <div class="cookiealert-container">
      <b>Do you like cookies?</b> &#x1F36A; We use cookies to ensure you get the best experience on our website. <a href="http://cookiesandyou.com/" target="_blank">Learn more</a>

      <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
          I agree
      </button>
  </div>
</div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/cookiealert.js') }}"></script>
@endpush