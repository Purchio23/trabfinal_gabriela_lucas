@extends('base.app')

@section('conteudo')
    @php
        if (!empty($reuniao->id)) {
            $route = route('reuniao.update', $reuniao->id);
        } else {
            $route = route('reuniao.store');
        }
    @endphp

    @section('tituloPagina', 'Formulário Reunião')

    <h1>Formulário Reunião</h1>

    <div class="col">
        <div class="row">
            <form action='{{ $route }}' method="POST">
                @csrf
                @if (!empty($reuniao->id))
                    @method('PUT')
                @endif

                <input type="hidden" name="id"
                    value="@if (!empty(old('id'))) {{ old('id') }} @elseif(!empty($reuniao->id)) {{ $reuniao->id }} @else {{ '' }} @endif" /><br>
                <div class="col-3">
                    <label class="form-label">Nome</label><br>
                    <input type="text" class="form-control" name="nome"
                        value="@if (!empty(old('nome'))) {{ old('nome') }} @elseif(!empty($reuniao->nome)) {{ $reuniao->nome }} @else {{ '' }} @endif" /><br>
                </div>
                <div class="col-3">
                    <label class="form-label">E-mail</label><br>
                    <input type="email" class="form-control" name="email"
                        value="@if (!empty(old('email'))) {{ old('email') }} @elseif(!empty($reuniao->email)) {{ $reuniao->email }} @else {{ '' }} @endif" /><br>
                </div>
                <div class="col-3">
                    <label class="form-label">Data</label><br>
                    <input type="date" class="form-control" name="data"
                        value="@if (!empty(old('data'))) {{ old('data') }} @elseif(!empty($reuniao->data)) {{ $reuniao->data }} @else {{ '' }} @endif" /><br>
                </div>
                <div class="col-3">
                    <label class="form-label">Horário</label><br>
                    <input type="time" class="form-control" name="horario"
                        value="@if (!empty(old('horario'))) {{ old('horario') }} @elseif(!empty($reuniao->horario)) {{ $reuniao->horario }} @else {{ '' }} @endif" /><br>
                </div>
                <button class="btn btn-success" type="submit">
                    <i class="fa-solid fa-save"></i> Salvar
                </button>
                <a href="{{ route('reuniao.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-arrow-left"></i> Voltar
                </a> <br><br>
            </form>
        </div>
    </div>
@endsection
