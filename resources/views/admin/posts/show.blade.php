@extends('admin.layouts.app')
@section('content')
    @component('admin.components.show')
        @slot('title', $post->title)
        @slot('form')
            @include('admin.posts.form', ['show' => true])
        @endslot
    @endcomponent
@endsection


@push('scripts')
    <script>
        $('.form-control').attr('readonly',true);
    </script>
@endpush