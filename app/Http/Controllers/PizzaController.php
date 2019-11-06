<?php

namespace App\Http\Controllers;

use App\Pizza;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index ()
    {
        return response()->json(Pizza::all());
    }

    public function show ($id)
    {
        if($pizza = Pizza::find($id)) {
            return response()->json(['success' => true, 'pizza' => $pizza]);
        }

        return response()->json(['success' => false, 'msg' => 'Nenhum registro encontrado!']);
    }

    public function save(Request $request)
    {
        try {
            Pizza::create($request->all());

            return response()->json(['success' => true, 'msg' => "Registro realizado com sucesso!"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => "[ERROR] Falha ao inserir essa pizza!"]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            /** @var Pizza $pizza */
            $pizza = Pizza::find($id);
            $pizza->update($request->all());

            return response()->json(['success' => true, 'msg' => "Registro atualizado com sucesso!"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => "[ERROR] Falha na atualização deste registro!"]);
        }
    }

    public function remove($id)
    {
        try {
            /** @var Pizza $pizza */
            $pizza = Pizza::find($id);
            $pizza->delete();

            return response()->json(['success' => true, 'msg' => "Registro deletado com sucesso!"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => "[ERROR] Falha ao deletar este registro"]);
        }
    }
}
