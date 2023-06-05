@extends('base.app')

@section('conteudo')
    @php
        if (!empty($curriculo->id)) {
            $route = route('curriculo.update', $curriculo->id);
        } else {
            $route = route('curriculo.store');
        }
    @endphp

    @section('tituloPagina', 'Formulário Currículo')

    <h1>Formulário Currículo</h1>

    <div class="col">
        <div class="row">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (!empty($curriculo->id))
                    @method('PUT')
                @endif

                <input type="hidden" name="curriculo_id"
                    value="@if (!empty(old('curriculo_id'))) {{ old('curriculo_id') }} @elseif(!empty($curriculo->id)) {{ $curriculo->id }} @else {{ '' }} @endif" /><br>
                <div class="col-3">
                    <label class="form-label">Nome Completo</label><br>
                    <input type="text" class="form-control" name="nome_completo"
                        value="@if (!empty(old('nome_completo'))) {{ old('nome_completo') }} @elseif(!empty($curriculo->nome)) {{ $curriculo->nome }} @else {{ '' }} @endif" /><br>
                </div>
                <div class="col-3">
                    <label class="form-label">Idade</label><br>
                    <input type="number" class="form-control" name="idade"
                        value="@if (!empty(old('idade'))) {{ old('idade') }} @elseif(!empty($curriculo->idade)) {{ $curriculo->idade }} @else {{ '' }} @endif" /><br>
                </div>
                <div class="col-3">
                    <label class="form-label">Gênero</label><br>
                    <input type="text" class="form-control" name="genero"
                        value="@if (!empty(old('genero'))) {{ old('genero') }} @elseif(!empty($curriculo->genero)) {{ $curriculo->genero }} @else {{ '' }} @endif" /><br>
                </div>
                <div class="col-3">
                    <label class="form-label">E-mail</label><br>
                    <input type="email" class="form-control" name="email"
                        value="@if (!empty(old('email'))) {{ old('email') }} @elseif(!empty($curriculo->email)) {{ $curriculo->email }} @else {{ '' }} @endif" /><br>
                </div>
                <div class="col-6">
                    <br>
                    <label class="form-label">Currículo (PDF)</label><br>
                    @if (!empty($curriculo->arquivo))
                        <a href="/storage/{{ $curriculo->arquivo }}" target="_blank">{{ $curriculo->arquivo }}</a><br><br>
                    @endif
                    <input type="file" class="form-control" name="curriculo" /><br>
                </div>
                <button class="btn btn-success" type="submit">
                    <i class="fa-solid fa-save"></i> Salvar
                </button>
                <a href="{{ route('curriculo.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-arrow-left"></i> Voltar
                </a> <br><br>
            </form>
        </div>
    </div>
@endsection
