<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico1;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class Servico1Controller extends Controller
{
    public function index()
    {
        $servico1s = Servico1::all();

        return view('Servico1List')->with(['servico1s' => $servico1s]);
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nome')->get();

        return view('Servico1Form')->with(['categorias' => $categorias]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:120',
            'telefone' => 'required|max:20',
            'email' => 'nullable|email|max:100',
            'categoria_id' => 'nullable',
            'imagem' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $imagem = $request->file('imagem');
        $nome_arquivo = '';

        if ($imagem) {
            $nome_arquivo = date('YmdHis') . '.' . $imagem->getClientOriginalExtension();

            $diretorio = 'imagem/';
            $imagem->storeAs($diretorio, $nome_arquivo, 'public');
            $dados['imagem'] = $diretorio . $nome_arquivo;
        }

        $dados = [
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'categoria_id' => $request->categoria_id,
            'imagem' => $diretorio . $nome_arquivo,
        ];

        Servico1::create($dados);

        return redirect('servico1')->with('success', 'Cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $servico1 = Servico1::findOrFail($id);
        $categorias = Categoria::orderBy('nome')->get();

        return view('Servico1Form')->with([
            'servico1' => $servico1,
            'categorias' => $categorias,
        ]);
    }

    public function show($id)
    {
        $servico1 = Servico1::findOrFail($id);
        $categorias = Categoria::orderBy('nome')->get();

        return view('Servico1Form')->with([
            'servico1' => $servico1,
            'categorias' => $categorias,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|max:120',
            'telefone' => 'required|max:20',
            'email' => 'nullable|email|max:100',
            'categoria_id' => 'nullable',
            'imagem' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $dados =  [
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'categoria_id' => $request->categoria_id,
        ];

        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_arquivo = date('YmdHis') . '.' . $imagem->getClientOriginalExtension();

            $diretorio = 'imagem/';
            $imagem->storeAs($diretorio, $nome_arquivo, 'public');
            $dados['imagem'] = $diretorio . $nome_arquivo;
        }

        Servico1::updateOrCreate(
            ['id' => $id],
            $dados
        );

        return redirect('servico1')->with('success', 'Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $servico1 = Servico1::findOrFail($id);

        if (!empty($servico1->imagem)) {
            if (Storage::disk('public')->exists($servico1->imagem)) {
                Storage::disk('public')->delete($servico1->imagem);
            }
        }

        $servico1->delete();

        return redirect('servico1')->with('success', 'Removido com sucesso!');
    }

    public function search(Request $request)
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

        return view('Servico1List')->with(['servico1s' => $servico1s]);
    }
}
