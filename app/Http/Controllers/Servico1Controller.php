<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico1;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class Servico1Controller extends Controller
{
    function index()
    {
        $servico1s = Servico1::All();
        // dd($servico1s);

        return view('Servico1List')->with(['servico1s' => $servico1s]);
    }

    function create()
    {
        $categorias = Categoria::orderBy('nome')->get();
        //dd($categorias);
        return view('Servico1Form')->with(['categorias' => $categorias]);
    }

    function store(Request $request)
    {
        $request->validate(
            Servico1::rules(),
            Servico1::messages()
        );

        //adiciono os dados do formulário ao vetor
        $dados = [
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'categoria_id' => $request->categoria_id,
        ];

        $imagem = $request->file('imagem');
        $nome_arquivo = '';
        //verifica se o campo imagem foi passado uma imagem
        if ($imagem) {
            $nome_arquivo = date('YmdHis') . '.' . $imagem->getClientOriginalExtension();

            $diretorio = 'imagem/';
            //salva a imagem em uma pasta
            $imagem->storeAs($diretorio, $nome_arquivo, 'public');
            //adiciona ao vetor o diretorio do arquivo e o nome
            $dados['imagem'] = $diretorio . $nome_arquivo;
        }

        //dd( $request->nome);
        //passa o vetor com os dados do formulário como parametro para ser salvo
        Servico1::create($dados);

        return \redirect('servico1')->with('success', 'Cadastrado com sucesso!');
    }

    function edit($id)
    {
        //select * from servico1 where id = $id;
        $servico1 = Servico1::findOrFail($id);
        //dd($servico1);
        $categorias = Categoria::orderBy('nome')->get();

        return view('Servico1Form')->with([
            'servico1' => $servico1,
            'categorias' => $categorias,
        ]);
    }

    function show($id)
    {
        //select * from servico1 where id = $id;
        $servico1 = Servico1::findOrFail($id);
        //dd($servico1);
        $categorias = Categoria::orderBy('nome')->get();

        return view('Servico1Form')->with([
            'servico1' => $servico1,
            'categorias' => $categorias,
        ]);
    }

    function update(Request $request)
    {
        //dd( $request->nome);
        $request->validate(
            Servico1::rules(),
            Servico1::messages()
        );

        //adiciono os dados do formulário ao vetor
        $dados =  [
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'categoria_id' => $request->categoria_id,
        ];

        $imagem = $request->file('imagem');
        //verifica se o campo imagem foi passado uma imagem
        if ($imagem) {
            $nome_arquivo = date('YmdHis') . '.' . $imagem->getClientOriginalExtension();

            $diretorio = 'imagem/';
            //salva a imagem em uma pasta
            $imagem->storeAs($diretorio, $nome_arquivo, 'public');
            //adiciona ao vetor o diretorio do arquivo e o nome
            $dados['imagem'] = $diretorio . $nome_arquivo;
        }

        //metodo para atualizar passando o vetor com os dados do form e o id
        Servico1::updateOrCreate(
            ['id' => $request->id],
            $dados
        );

        return \redirect('servico1')->with('success', 'Atualizado com sucesso!');
    }

    function destroy($id)
    {
        $servico1 = Servico1::findOrFail($id);

        //verifica se existe o arquivo vinculado ao registro e depois remove
        if (Storage::disk('public')->exists($servico1->imagem)) {
            Storage::disk('public')->delete($servico1->imagem);
        }
        $servico1->delete();

        return \redirect('servico1')->with('success', 'Removido com sucesso!');
    }

    function search(Request $request)
    {
        if ($request->campo == 'nome') {
            $servico1s = Servico1::where(
                'nome',
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $servico1s = Servico1::all();
        }

        //dd($servico1s);
        return view('Servico1List')->with(['servico1s' => $servico1s]);
    }
}
