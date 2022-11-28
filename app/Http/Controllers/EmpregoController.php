<?php

namespace App\Http\Controllers;

class EmpregoController extends Controller
{
    public function consultar()
    {
        return response()->json(['nome' => 'Coca-Cola']);
    }
}

?>