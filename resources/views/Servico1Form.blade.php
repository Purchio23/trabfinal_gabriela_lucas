@extends('base.app')

@section('conteudo')
    @php
        if (!empty($servico1->id)) {
            $route = route('servico1.update', $servico1->id);
        } else {
            $route = route('servico1.store');
        }
    @endphp
@section('tituloPagina', 'Formulário Usuário')


<div class="col">
    <div class="row">
        <h1>Formulário servico de Coprodução</h1>
        <form action='{{ $route }}' method="POST" enctype="multipart/form-data">
            @csrf
            @if (!empty($servico1->id))
                @method('PUT')
            @endif

            <input type="hidden" name="id"
                value="@if (!empty(old('id'))) {{ old('id') }} @elseif(!empty($servico1->id)) {{ $servico1->id }} @else {{ '' }} @endif" /><br>
            <div class="col-3">
                <label class="form-label">Nome</label><br>
                <input type="text" class="form-control" name="nome"
                    value="@if (!empty(old('nome'))) {{ old('nome') }} @elseif(!empty($servico1->nome)) {{ $servico1->nome }} @else {{ '' }} @endif" /><br>
            </div>
            <div class="col-3">
                <label class="form-label">Telefone</label><br>
                <input type="text" class="form-control" name="telefone"
                    value="@if (!empty(old('telefone'))) {{ old('telefone') }} @elseif(!empty($servico1->telefone)) {{ $servico1->telefone }} @else {{ '' }} @endif" /><br>
            </div>
            <div class="col-3">
                <label class="form-label">E-mail</label><br>
                <input type="email" class="form-control" name="email"
                    value="@if (!empty(old('email'))) {{ old('email') }} @elseif(!empty($servico1->email)) {{ $servico1->email }} @else {{ '' }} @endif" /><br>
            </div>
            <div class="col-3">
                <label class="form-label">Categoria</label><br>
                <select name="categoria_id" class="form-select">
                    @foreach ($categorias as $item)
                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                    @endforeach
                </select>
            </div>
           
            <button class="btn btn-success" type="submit">
                <i class="fa-solid fa-save"></i> Salvar
            </button>
            <a href='{{ route('servico1.index') }}' class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
                Voltar</a> <br><br>
        </form>
    </div>
</div>
</div>
@endsection
