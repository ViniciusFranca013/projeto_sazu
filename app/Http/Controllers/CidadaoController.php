<?php

namespace App\Http\Controllers;

use App\Models\Cidadao;
use App\Models\Ocorrencia;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CidadaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

                $usertype = Auth()->user()->usertype; 
            $user_id = Auth()->user()->id; 
            
            $cidadaos = DB::select('SELECT * FROM cidadaos WHERE fk_usuario = ?',[$user_id]); 
            
            $cidadaos_id = DB::selectOne('SELECT Id_cidadao FROM cidadaos WHERE fk_usuario = ?', [$user_id]); 
                        
            $ocorrencias = DB::select('SELECT * FROM ocorrencias WHERE FK_CIDADAO_Id_cidadao = ?',
             [$cidadaos_id->Id_cidadao] // ALTERADO: pega o Id_cidadao dentro do objeto
                );

        if($usertype== "user")
        {
            return view('cidadaos.index', compact('cidadaos', 'ocorrencias', 'cidadaos_id'));
            

        }

        else if($usertype== 'admin')
        {
            return view('admin.adminhome');
        }

        else{
            return redirect()->back();
        }
        
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

        return redirect()->route('cidadaos.index')->with('success', 'Post created successfully.');
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
