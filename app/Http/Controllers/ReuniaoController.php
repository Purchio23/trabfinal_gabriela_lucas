<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reuniao;

class ReuniaoController extends Controller
{
    public function index()
    {
        $reunioes = Reuniao::all();

        return view('ReuniaoList')->with(['reunioes' => $reunioes]);
    }

    public function create()
    {
        return view('ReuniaoForm');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:120',
            'email' => 'nullable|email|max:100',
            'data' => 'required|date',
            'horario' => 'required',
        ]);

        $dados = [
            'nome' => $request->nome,
            'email' => $request->email,
            'data' => $request->data,
            'horario' => $request->horario,
        ];

        Reuniao::create($dados);

        return redirect('reuniao')->with('success', 'Cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $reuniao = Reuniao::findOrFail($id);

        return view('ReuniaoForm')->with(['reuniao' => $reuniao]);
    }

    public function show($id)
    {
        $reuniao = Reuniao::findOrFail($id);

        return view('ReuniaoForm')->with(['reuniao' => $reuniao]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:120',
            'email' => 'nullable|email|max:100',
            'data' => 'required|date',
            'horario' => 'required',
        ]);

        $dados = [
            'nome' => $request->nome,
            'email' => $request->email,
            'data' => $request->data,
            'horario' => $request->horario,
        ];

        Reuniao::updateOrCreate(['id' => $request->id], $dados);

        return redirect('reuniao')->with('success', 'Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $reuniao = Reuniao::findOrFail($id);
        $reuniao->delete();

        return redirect('reuniao')->with('success', 'Removido com sucesso!');
    }

    public function search(Request $request)
    {
        if ($request->campo == 'nome') {
            $reunioes = Reuniao::where('nome', 'like', '%' . $request->valor . '%')->get();
        } else {
            $reunioes = Reuniao::all();
        }

        return view('ReuniaoList')->with(['reunioes' => $reunioes]);
    }
}
