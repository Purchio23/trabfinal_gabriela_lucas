@extends('base.app')

@section('conteudo')
    @php
        if (!empty($vaga->id)) {
            $route = route('vaga.update', $vaga->id);
        } else {
            $route = route('vaga.store');
        }
    @endphp
@section('tituloPagina', 'Formulário Usuário')

<h1>Formulário de Currículo a vaga</h1>

<div class="col">
    <div class="row">
        <form action='{{ $route }}' method="POST" enctype="multipart/form-data">
            @csrf
            @if (!empty($vaga->id))
                @method('PUT')
            @endif

            <input type="hidden" name="id"
                value="@if (!empty(old('id'))) {{ old('id') }} @elseif(!empty($vaga->id)) {{ $vaga->id }} @else {{ '' }} @endif" /><br>
            <div class="col-3">
                <label class="form-label">Nome</label><br>
                <input type="text" class="form-control" name="nome"
                    value="@if (!empty(old('nome'))) {{ old('nome') }} @elseif(!empty($vaga->nome)) {{ $vaga->nome }} @else {{ '' }} @endif" /><br>
            </div>
            <div class="col-3">
                <label class="form-label">Telefone</label><br>
                <input type="text" class="form-control" name="telefone"
                    value="@if (!empty(old('telefone'))) {{ old('telefone') }} @elseif(!empty($vaga->telefone)) {{ $vaga->telefone }} @else {{ '' }} @endif" /><br>
            </div>
            <div class="col-3">
                <label class="form-label">E-mail</label><br>
                <input type="email" class="form-control" name="email"
                    value="@if (!empty(old('email'))) {{ old('email') }} @elseif(!empty($vaga->email)) {{ $vaga->email }} @else {{ '' }} @endif" /><br>
            </div>
            <div class="col-3">
                <label class="form-label">Idade</label><br>
                <input type="text" class="form-control" name="idade"
                    value="@if (!empty(old('idade'))) {{ old('idade') }} @elseif(!empty($vaga->idade)) {{ $vaga->idade }} @else {{ '' }} @endif" /><br>
            </div>
                </select>
            </div>
            @php
                $nome_imagem = !empty($vaga->imagem) ? $vaga->imagem : 'sem_imagem.jpg';
            @endphp
            <div class="col-6">
            <label class="form-label">Insira seu curriculo em .PNG</label><br>
                <input type="file" class="form-control" name="imagem" /><br>
            </div>
            <button class="btn btn-success" type="submit">
                <i class="fa-solid fa-save"></i> Salvar
            </button>
            <a href="{{ route('vaga.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
                Voltar</a> <br><br>
        </form>
    </div>
</div>
</div>
@endsection
