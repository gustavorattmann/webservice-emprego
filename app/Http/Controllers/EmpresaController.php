<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Empresa;
use BrasilApi;

class EmpresaController extends Controller
{
    public function consultar($id = null)
    {
        try {
            if (empty($id)) {
                $empresa = DB::table('empresas')->get();
            } else {
                $empresa = DB::table('empresas')->where('id', $id)->get();
            }

            if (count($empresa) > 0) {
                return response($empresa, 200);
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
                $empresa = DB::table('empresas')->where('nome', $request->input('nome'))->get();
                
                if (count($empresa) < 1) {
                    $empresa = new Empresa;

                    $complemento = NULL;
    
                    if ($request->has('complemento') && $request->filled('complemento')) {
                        $complemento = $request->input('complemento');
                    }
    
                    $empresa->nome = $request->input('nome');
    
                    $endereco = BrasilApi::cep($request->input('cep'));
    
                    $empresa->cep = $endereco['cep'];
                    $empresa->endereco = $endereco['street'];
                    $empresa->numero = $request->input('numero');
                    $empresa->complemento = $complemento;
                    $empresa->bairro = $endereco['neighborhood'];
                    $empresa->cidade = $endereco['city'];
                    $empresa->uf = $endereco['state'];
    
                    if ($empresa->save()) {
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
