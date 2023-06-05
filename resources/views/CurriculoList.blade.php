@extends('base.app')

@section('conteudo')
    @section('tituloPagina', 'Listagem de Currículos')
    <h1>Listagem de Currículos</h1>
    <form action="{{ route('curriculo.search') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-2">
                <select name="campo" class="form-select">
                    <option value="nome_completo">Nome</option>
                    <option value="idade">Idade</option>
                    <option value="genero">Gênero</option>
                    <option value="email">Email</option>
                </select>
            </div>
            <div class="col-4">
                <input type="text" class="form-control" placeholder="Pesquisar" name="valor" />
            </div>
            <div class="col-6">
                <button class="btn btn-primary" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i> Buscar
                </button>
                <a class="btn btn-success" href="{{ action('App\Http\Controllers\CurriculoController@create') }}"><i
                        class="fa-solid fa-plus"></i> Cadastrar</a>
            </div>
        </div>
    </form>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Idade</th>
                <th scope="col">Gênero</th>
                <th scope="col">Email</th>
                <th scope="col">Currículo</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($curriculos as $curriculo)
                <tr>
                    <td scope='row'>{{ $curriculo->id }}</td>
                    <td>{{ $curriculo->nome_completo }}</td>
                    <td>{{ $curriculo->idade }}</td>
                    <td>{{ $curriculo->genero }}</td>
                    <td>{{ $curriculo->email }}</td>
                    <td>{{ $curriculo->curriculo }}</td>
                    <td>
                        <a href="{{ action('App\Http\Controllers\CurriculoController@edit', $curriculo->id) }}"><i
                                class='fa-solid fa-pen-to-square' style='color:orange;'></i></a>
                    </td>
                    <td>
                        <form method="POST"
                            action="{{ action('App\Http\Controllers\CurriculoController@destroy', $curriculo->id) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" onclick='return confirm("Deseja Excluir?")' style='all: unset;'><i
                                    class='fa-solid fa-trash' style='color:red;'></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
