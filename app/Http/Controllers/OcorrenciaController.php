<?php

namespace App\Http\Controllers;

use App\Models\Ocorrencia;
use App\Models\Cidadao;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OcorrenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ocorrencias = Ocorrencia::latest()->paginate(10);
        return view('ocorrencias.index', compact('ocorrencias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ocorrencias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $validatedData = $request->validate([
            'Tipo_ocorrencia' => 'required|max:255',
            'Rua' => 'required|max:255',
            'Numero' => 'required|max:255',
            'Cidade' => 'required|max:255',
            'situação' => 'required|max:255',
            'CEP' => 'required|max:255',
            'foto' => 'required|max:255',
            'descricao_problema' => 'required|max:255',
            'prioridade_problema' => 'required|max:255',
            'bairro'=> 'required|max:255',
            'data_ocorrencia' => 'required|max:255',
        ]);

        $user = auth()->user();
        $id_usuario = $user->id;

        $cidadao = Cidadao::where('fk_usuario', $id_usuario)->first();

        $validatedData['FK_CIDADAO_Id_cidadao'] = $cidadao->Id_cidadao;

        

        Ocorrencia::create($validatedData);

       
     

        return redirect()->route('cidadaos.index')->with('success', 'Ocorrencia created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ocorrencia $ocorrencia)
    {
        return view('ocorrencias.show', compact('ocorrencia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ocorrencia $ocorrencia)
    {
        return view('ocorrencias.edit', compact('ocorrencia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ocorrencia $ocorrencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ocorrencia $ocorrencia)
    {
        $ocorrencia->delete();

        return redirect()->route('ocorrencias.index')->with('success', 'Post deleted successfully.');
    }
}
