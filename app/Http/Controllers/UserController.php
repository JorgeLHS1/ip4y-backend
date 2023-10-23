<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\CpfRule;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (User::where('cpf', $request->cpf)->exists()) {
            return response()->json(['error' => 'CPF já cadastrado'], 422);
        }

        if(User::where('email', $request->email)->exists()) {
            return response()->json(['error' => 'E-mail já cadastrado'], 422);
        }

        $validatedData = $request->validate([
            'cpf' => ['required', 'size:14', new CpfRule],
            'nome' => 'required',
            'sobrenome' => 'required',
            'data_nascimento' => 'required|date',
            'email' => 'required|email',
            'genero' => 'required|in:Feminino,Masculino,Outro',
        ]);
        $user = User::create($validatedData);
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'Usuário não encontrado'
            ], 404);
        }

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'cpf' => ['required', 'size:14', new CpfRule],
            'nome' => 'required',
            'sobrenome' => 'required',
            'data_nascimento' => 'required|date',
            'email' => 'required|email',
            'genero' => 'required|in:Feminino,Masculino,Outro',
        ]);
        $user->update($validatedData);

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);

        return response()->json([
            'message' => 'Usuário excluído'
        ]);
    }

    public function sendToApi()
    {
        $users = User::all();

        $response = $this->client->request('POST', 'https://api-teste.ip4y.com.br/cadastro', [
            'json' => $users->toArray()
        ]);

        return $response->getStatusCode();
    }
}
