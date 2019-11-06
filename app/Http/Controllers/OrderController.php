<?php

namespace App\Http\Controllers;

use App\Address;
use App\Client;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index ()
    {
        return response()->json(Order::all());
    }

    public function show ($id)
    {
        if($order = Order::find($id)) {
            return response()->json(['success' => true, 'order' => $order]);
        }

        return response()->json(['success' => false, 'msg' => 'Nenhum registro encontrado!']);
    }

    public function save(Request $request)
    {
        try {
            $phone = trim(str_replace(['(', ')', '-'], '', $request->get('phone')));

            $client = Client::where('phone', $phone)->get();
            $address = $client->address->find($request->get('address_id'));

            if (!$address) {
                $address = Address::create($request->all());
            }

            Order::create(
                [
                    'client_id' => $client->id,
                    'address_id' => $address->id,
                    'pizza_id' => $request->get('pizza_id'),
                    'status' => Order::STATUS_CREATED
                ]
            );

            return response()->json(['success' => true, 'msg' => "Pedido realizado com sucesso!"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => "[ERROR] Falha ao realizar o pedido!"]);
        }
    }

    public function finalizedOrder($id)
    {
        try {
            /** @var Order $order */
            $order = Order::find($id);
            $order->update(['status' => Order::STATUS_FINALIZED]);
            return response()->json(['success' => true, 'msg' => "Pedido finalizado com sucesso!"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => "[ERROR] Falha ao finalizado este pedido"]);
        }
    }

    public function cancel($id)
    {
        try {
            /** @var Order $order */
            $order = Order::find($id);
            $order->update(['status' => Order::STATUS_CANCELED]);

            return response()->json(['success' => true, 'msg' => "Pedido cancelado com sucesso!"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => "[ERROR] Falha ao cancelar este pedido"]);
        }
    }
}
