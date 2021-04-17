@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <h1>Contato</h1>
            <form method="post" action="{{ route('send_contact') }}">
                {{ csrf_field() }}
                <div class="form-group col-12">
                    <label for="title" class="required">Nome </label>
                    <input type="text" name="name" id="name" required class="form-control">
                </div>
                <div class="form-group col-12">
                    <label for="email" class="required">E-mail </label>
                    <input type="email" name="email" id="email" required class="form-control" autofocus>
                </div>
                <div class="form-group col-12">
                    <label for="subject" class="required">Assunto </label>
                    <input type="text" name="subject" id="subject" required class="form-control" autofocus>
                </div>
                <div class="form-group col-12">
                    <label for="message" class="required">Mensagem </label>
                    <textarea name="message" id="message" required class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/components/sweetAlert.js') }}"></script>
@endpush