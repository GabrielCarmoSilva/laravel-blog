<div class="row">
    <div class="form-group col-12">
        <label for="title" class="required">Título </label>
        <input type="text" name="title" id="title" required class="form-control" autofocus value="{{ old('title', $post->title )}}">
    </div>
    <div class="form-group col-12">
        <label for="subtitle" class="required">Subtítulo </label>
        <input type="text" name="subtitle" id="subtitle" required class="form-control" autofocus value="{{ old('subtitle', $post->subtitle )}}">
    </div>
    <div class="form-group col-12">
        <label for="abstract" class="required">Resumo </label>
        <input type="text" name="abstract" id="abstract" required class="form-control" autofocus value="{{ old('abstract', $post->abstract )}}">
    </div>
    <div class="form-group col-12">
        <label for="image">Imagem </label><br>
        @if(Route::is('posts.show'))
            <img class="img-fluid" src={{ asset('storage/' . $post->image) }} width="400" height="400">
        @else    
            <input type="file" name="image" id="image" autofocus>
        @endif
    </div>
    <div class="form-group col-12">
        <label for="text" class="required">Texto </label>
        <textarea rows="6" name="text" id="text" required autofocus class="form-control">{{ old('text', $post->text) }}</textarea>
    </div>
    <div class="form-group col-12">
        <label for="client" class="required">Categoria </label>
        <select class="form-control select2" name="category_id" required value="{{ old('category_id', $post->category_id) }}">
            <option></option>
            @foreach($categories as $category)
                @if((Route::is('posts.edit') || Route::is('posts.show')) && $category->id === $post->category_id)
                    <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                @else
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif    
            @endforeach
        </select>
    </div>
</div>

@push('scripts')
    <script>
        $(function(){
            $('.select2').select2();
        })
        $('select[value]').each(function(){
            $(this).val($(this).attr('value'));
        })
    </script>
@endpush