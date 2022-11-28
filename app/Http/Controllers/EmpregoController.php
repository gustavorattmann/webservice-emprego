<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Emprego;
use BrasilApi;

class EmpregoController extends Controller
{
    public function consultar($id = null)
    {
        try {
            if (empty($id)) {
                $emprego = DB::table('empregos')->get();
            } else {
                $emprego = DB::table('empregos')->where('id', $id)->get();
            }

            if (count($emprego) > 0) {
                return response($emprego, 200);
            } else {
                return response(['mensagem' => 'Empresa não encontrada!'], 404);
            }
        } catch (Exception $error) {
            return response($error, 500);

            return false;
        }
    }

    public function cadastrar(Request $request)
    {
        if ($request->has(['nome', 'cep', 'numero']) && $request->filled(['nome', 'cep', 'numero'])) {
            try {
                $emprego = DB::table('empregos')->where('nome', $request->input('nome'))->get();
                
                if (count($emprego) < 1) {
                    $emprego = new Emprego;

                    $complemento = NULL;
    
                    if ($request->has('complemento') && $request->filled('complemento')) {
                        $complemento = $request->input('complemento');
                    }
    
                    $emprego->nome = $request->input('nome');
    
                    $endereco = BrasilApi::cep($request->input('cep'));
    
                    $emprego->cep = $endereco['cep'];
                    $emprego->endereco = $endereco['street'];
                    $emprego->numero = $request->input('numero');
                    $emprego->complemento = $complemento;
                    $emprego->bairro = $endereco['neighborhood'];
                    $emprego->cidade = $endereco['city'];
                    $emprego->uf = $endereco['state'];
    
                    if ($emprego->save()) {
                        return response(['mensagem' => 'Cadastro realizado com sucesso!'], 201);
                    } else {
                        return response(['mensagem' => 'Não foi possível realizar cadastro!'], 400);
                    }
                } else {
                    return response(['mensagem' => 'Empresa já está cadastrada!'], 400);
                }
            } catch (Exception $error) {
                return response($error, 500);
 
                return false;
            }
        } else {
            return response(['mensagem' => 'Faltando parâmetros!'], 400);
        }
    }
}
