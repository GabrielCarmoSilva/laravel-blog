@extends('admin.layouts.app')
@section('content')
    @component('admin.components.show')
        @slot('title', $user->name)
        @slot('form')
            @include('admin.users.form')
        @endslot
    @endcomponent
@endsection


@push('scripts')
    <script>
        $('.form-control').attr('readonly',true);
        $("id-select2"). prop("disabled", true);
    </script>
@endpush