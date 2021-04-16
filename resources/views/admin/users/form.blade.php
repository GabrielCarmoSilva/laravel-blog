<div class="row">
    <div class="form-group col-12">
        <label for="name" class="required">Nome </label>
        <input type="text" name="name" id="name" required class="form-control" autofocus value="{{ old('name', $user->name )}}">
    </div>
    @can('approve', App\User::class)
        <div class="form-group col-12">
            <label for="user_level" class="required" >Nível de Usuário </label>
            @if(Route::is('users.show'))
                <p>{{ $user->status == 0 ? 'Usuário' : 'Administrador' }}</p>
            @else
                <select name="user_level" id="user_level" class="form-control select2" value="{{ old('user_level', $user->user_level) }}">
                    <option value="0">Usuário</option>
                    <option value="1">Administrador</option>
                </select>
            @endif
        </div>
    @endcan    
    <div class="form-group col-12">
        <label for="email" class="required">E-mail </label>
        <input type="email" name="email" id="email" autocomplete="off" required class="form-control" value="{{ old('email', $user->email )}}">
    </div>
    <div class="form-group col-12">
        <label for="image">Imagem </label><br>
        @if(Route::is('users.show'))
            <img class="img-fluid" src={{ asset('storage/' . $user->image) }} width="400" height="400">
        @else    
            <input type="file" name="image" id="image" autofocus>
        @endif
    </div>
    
    @if(!isset($show))
        @if(Route::is('users.edit'))
            <div class="form-group col-12">
                <label for="password">Senha </label>
                <input type="password" autocomplete="password" name="password"  id="password"  class="form-control" >
            </div>
            <div class="form-group col-12">
                <label for="confirm_password">Confirme sua senha </label>
                <input type="password" name="confirm_password" autocomplete="password" id="password" class="form-control">
            </div>
        @else
            <div class="form-group col-12">
                <label for="password" class="required">Senha </label>
                <input type="password" name="password"  id="password" required class="form-control" >
            </div>
            <div class="form-group col-12">
                <label for="confirm_password" class="required">Confirme sua senha </label>
                <input type="password" name="confirm_password" id="password" required class="form-control">
            </div>
        @endif
    @endif
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