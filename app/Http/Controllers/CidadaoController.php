<?php

namespace App\Http\Controllers;

use App\Models\Cidadao;
use App\Models\Ocorrencia;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CidadaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

            $usertype = Auth()->user()->usertype; 
            $user_id = Auth()->user()->id; 
            $resultado = DB::select('SELECT COUNT(*) AS total FROM ocorrencias'); 
            $ocorrencias_aberto = $resultado[0]->total; 

            $resultado_2 = DB::select('SELECT COUNT(*) AS total_1 FROM ocorrencias where situação ="Em análise" '); 
            $ocorrencias_analise = $resultado_2[0]->total_1; 

            $resultado_3 = DB::select('SELECT COUNT(*) AS total_2 FROM ocorrencias where situação ="Deferido" '); 
            $ocorrencias_deferido = $resultado_3[0]->total_2; 

            $resultado_4 = DB::select('SELECT COUNT(*) AS total_3 FROM ocorrencias where situação ="Resolvido" '); 
            $ocorrencias_resolvido = $resultado_4[0]->total_3; 
            
            $cidadaos = DB::select('SELECT * FROM cidadaos WHERE fk_usuario = ?',[$user_id]); 
            $cidadaos_id = DB::selectOne('SELECT Id_cidadao FROM cidadaos WHERE fk_usuario = ?', [$user_id]);      
            $ocorrencias = DB::select('SELECT * FROM ocorrencias WHERE FK_CIDADAO_Id_cidadao = ?',
             [$cidadaos_id->Id_cidadao]); // ALTERADO: pega o Id_cidadao dentro do objeto




        // NOVO: busca todas as ocorrências que possuem localização
        $ocorrenciasMapa = Ocorrencia::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get([
                'id_reclamacao',
                'Tipo_ocorrencia',
                'Rua',
                'Numero',
                'bairro',
                'Cidade',
                'latitude',
                'longitude',
                'foto',                    // NOVO
                'situação',                // NOVO
                'prioridade_problema',     // NOVO
                'data_ocorrencia'          // NOVO
                
            ]);

        if($usertype== 'admin')
        {
            return view('admin.adminhome', compact('cidadaos', 'ocorrencias', 'cidadaos_id', 'ocorrenciasMapa', 'ocorrencias_aberto', 'ocorrencias_analise', 'ocorrencias_deferido'));
        }

        else if ($usertype== "user")
        {
            return view('cidadaos.index',  compact('cidadaos', 'ocorrencias', 'cidadaos_id', 'ocorrenciasMapa'));
        }

        

        else{
            return redirect()->back();
        }

        // NOVO: busca as ocorrências que possuem localização
        $ocorrencias = Ocorrencia::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get([
                'id_reclamacao',
                'Tipo_ocorrencia',
                'Rua',
                'Numero',
                'bairro',
                'Cidade',
                'latitude',
                'longitude'
            ]);
        
    }

    public function perfil()
    {
        return view('aluno.perfil');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cidadaos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {

        $validatedData = $request->validate([
            'CPF' => 'required|unique:cidadaos,CPF|max:14',
            'Bairro' => 'required|string',
            'Cidade' => 'required|string',
            'nome' => 'required|string',
            'data_nascimento' => 'required|date',
            'telefone' => 'required|string|unique:cidadaos,telefone|max:14',
            'email' => 'required|string|email|max:50',
            'cep' => 'required|string',
            'rua' => 'required|string',
            'numero' => 'required|string',
        ]);

                $user = User::create([
                'usertype'=>'user',
                'email' => $request->email,
                'password' => Hash::make($request->CPF),
                ]);

        

      $validatedData['fk_usuario'] = $user->id;
        Cidadao::create($validatedData);

        // ALTERADO: autentica o usuário recém-criado
        Auth::login($user);

        // ALTERADO: regenera a sessão após o login
        $request->session()->regenerate();

        return redirect()->route('cidadaos.index')
            ->with('success', 'Cadastro realizado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cidadao $cidadao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cidadao $cidadao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cidadao $cidadao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cidadao $cidadao)
    {
        //
    }
}
