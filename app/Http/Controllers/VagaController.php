<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaga;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class VagaController extends Controller
{
    public function index()
    {
        $vagas = Vaga::all();

        return view('VagaList')->with(['vagas' => $vagas]);
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nome')->get();

        return view('VagaForm')->with(['categorias' => $categorias]);
    }

    public function store(Request $request)
    {
        $request->validate(
            Vaga::rules(),
            Vaga::messages()
        );

        //adiciono os dados do formulário ao vetor
        $dados = [
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'idade' => $request->idade,
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

        //passa o vetor com os dados do formulário como parametro para ser salvo
        Vaga::create($dados);

        return redirect('vaga')->with('success', 'Cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $vaga = Vaga::findOrFail($id);
        $categorias = Categoria::orderBy('nome')->get();

        return view('VagaForm')->with([
            'vaga' => $vaga,
            'categorias' => $categorias,
        ]);
    }

    public function show($id)
    {
        $vaga = Vaga::findOrFail($id);
        $categorias = Categoria::orderBy('nome')->get();

        return view('VagaForm')->with([
            'vaga' => $vaga,
            'categorias' => $categorias,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate(
            Vaga::rules(),
            Vaga::messages()
        );

        //adiciono os dados do formulário ao vetor
        $dados =  [
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'idade' => $request->idade,
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
        Vaga::updateOrCreate(
            ['id' => $request->id],
            $dados
        );

        return redirect('vaga')->with('success', 'Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $vaga = Vaga::findOrFail($id);

        if (!empty($vaga->imagem)) {
            if (Storage::disk('public')->exists($vaga->imagem)) {
                Storage::disk('public')->delete($vaga->imagem);
            }
        }

        $vaga->delete();

        return redirect('vaga')->with('success', 'Removido com sucesso!');
    }

    public function search(Request $request)
    {
        if ($request->campo == 'nome') {
            $vagas = Vaga::where(
                'nome',
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $vagas = Vaga::all();
        }

        return view('VagaList')->with(['vagas' => $vagas]);
    }
}
