@extends('base.app')
@section('conteudo')
@section('tituloPagina', 'Princípal')
<div class="col" style="padding: 5%">
    <div class="row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Listagem Currículos</h5>
                    <p class="card-text">Descrição aqui</p>
                    <a href="{{('vaga')}}" class="btn btn-primary">Clique aqui</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Listagem serviços </h5>
                    <p class="card-text">Descrição aqui</p>
                    <a href="{{ url('/servico1') }}" class="btn btn-primary">Clique aqui</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Listagem de reuniões</h5>
                    <p class="card-text">Descrição aqui</p>
                    <a href="{{ url('/reuniao') }}" class="btn btn-primary">Clique aqui</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Listagem de usuários </h5>
                    <p class="card-text">Descrição aqui</p>
                    <a href="{{ url('/usuario') }}" class="btn btn-primary">Clique aqui</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
