@extends('admin.layouts.app')

@section('content')
    @component('admin.components.table')
        @slot('title', 'Listagem de Posts')
        @slot('create', route('posts.create'))
        @slot('head')
            <th>Título</th>
            <th>Autor</th>
            <th>Data</th>
            <th></th>
        @endslot
        @slot('body')
            @foreach($posts as $post)
                @can('view', $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->creation_date }}</td>
                        <td class="options"> 
                                <a href="{{ route('posts.edit', $post->id ) }}" class="btn btn-primary"><i class="fas fa-pen"></i></a>
                                <a href="{{ route('posts.show', $post->id ) }}" class="btn btn-dark"><i class="fas fa-search"></i></a>
                                <form action="{{ route('posts.destroy', $post->id) }}" class="form-delete" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                        </td>
                    </tr>
                @endcan   
            @endforeach
        @endslot
    @endcomponent
@endsection

@push('scripts')
        <script src="{{ asset('js/components/dataTable.js') }}"></script>
        <script src="{{ asset('js/components/sweetAlert.js') }}"></script>
@endpush
    