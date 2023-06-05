<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculo;

class CurriculoController extends Controller
{
    public function index()
    {
        $curriculos = Curriculo::all();

        return view('CurriculoList')->with(['curriculos' => $curriculos]);
    }

    public function create()
    {
        return view('CurriculoForm');
    }

    public function store(Request $request)
    {
        // Lógica de armazenamento do currículo
    }

    public function show($id)
    {
        $curriculo = Curriculo::find($id);

        return view('CurriculoForm')->with(['curriculo' => $curriculo]);
    }

    public function edit($id)
    {
        $curriculo = Curriculo::find($id);

        return view('CurriculoForm')->with(['curriculo' => $curriculo]);
    }

    public function update(Request $request, $id)
    {
        // Lógica de atualização do currículo
    }

    public function destroy($id)
    {
        $curriculo = Curriculo::find($id);
        $curriculo->delete();

        return redirect()->route('curriculo.index')->with('success', 'Currículo removido com sucesso!');
    }

    public function search(Request $request)
    {
        if ($request->campo == 'nome_completo') {
            $curriculos = Curriculo::where('nome_completo', 'like', '%' . $request->valor . '%')->get();
        } else {
            $curriculos = Curriculo::all();
        }

        return view('CurriculoList')->with(['curriculos' => $curriculos]);
    }
}
