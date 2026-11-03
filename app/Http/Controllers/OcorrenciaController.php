<?php

namespace App\Http\Controllers;

use App\Models\Ocorrencia;
use Illuminate\Support\Facades\Storage;
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
        return view('cidadaos.index', compact('cidadaos'));
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
            'CEP' => 'required|max:255',
           'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'descricao_problema' => 'required|max:255',
            'prioridade_problema' => 'required|max:255',
            'bairro'=> 'required|max:255',
            'data_ocorrencia' => 'required|date',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ], [
                'latitude.required' => 'Selecione o local do mapa.',
                'longitude.required' => 'Selecione o local do mapa.',
            ]);

        
        $foto =  rand(0,9999) . '-' . $request->file('foto')->getClientOriginalName();
        $path = $request->file('foto')->storeAs('uploads', $foto, 'public');

        $validatedData['foto'] = $path;

        $validatedData['situação'] = 'Em análise'; // ALTERADO
        $user = auth()->user();
        $id_usuario = $user->id;
        $cidadao = Cidadao::where('fk_usuario', $id_usuario)->first();
        $validatedData['FK_CIDADAO_Id_cidadao'] = $cidadao->Id_cidadao;
        Ocorrencia::create($validatedData);
        return redirect()->route('cidadaos.index')->with('success', 'Ocorrencia registrada com sucesso.');
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
        $validatedData = $request->validate([
            'Tipo_ocorrencia' => 'required|max:255',
            'Rua' => 'required|max:255',
            'Numero' => 'required|max:255',
            'Cidade' => 'required|max:255',
            'CEP' => 'required|max:255',
           'foto' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'descricao_problema' => 'required|max:255',
            'prioridade_problema' => 'required|max:255',
            'bairro'=> 'required|max:255',
            'data_ocorrencia' => 'required|date',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $ocorrencia->update($validatedData);

        $fotoAntiga = $ocorrencia->foto;

        // NOVO: verifica se o usuário selecionou uma nova foto
        if ($request->hasFile('foto')) {

            // NOVO: cria um nome para a nova foto
            $nomeFoto = uniqid() . '.' .
                $request->file('foto')->getClientOriginalExtension();

            // NOVO: salva a nova foto em storage/app/public/uploads
            $caminhoNovo = $request->file('foto')->storeAs(
                'uploads',
                $nomeFoto,
                'public'
            );

            // NOVO: atualiza o caminho da foto no banco
            $validatedData['foto'] = $caminhoNovo;
        }

        // Atualiza os dados da ocorrência
        $ocorrencia->update($validatedData);

        // NOVO: exclui a foto antiga somente depois da atualização
        if ($request->hasFile('foto') && $fotoAntiga) {
            Storage::disk('public')->delete($fotoAntiga);
        }
        return redirect()->route('cidadaos.index')->with('success', 'Ocorrencia atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ocorrencia $ocorrencia)
    {
        $ocorrencia->delete();

        return redirect()->route('cidadaos.index')->with('success', 'Ocorrência deletada com sucesso.');
    }
}
