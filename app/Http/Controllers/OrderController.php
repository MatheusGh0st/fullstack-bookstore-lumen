<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Mockery\Exception;

class OrderController extends Controller
{
    public function index()
    {
        return Order::all();
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $field = $request->input();

            $language = new Order();
            $language->fill([
                'cart_id' => $field['cart_id'],
                'quantity' => $field['quantity'],
                'customer_id' => $field['customer_id'],
                'order_date' => $field['order_date'],
                'address' => $field['address'],
                'status' => $field['status'],
                'payment' => $field['payment'],
            ]);

            if ($language->save())
            {
                return response()->json(['message' => 'Order created successfully']);
            }

            return response()->json(['error' => 'Order not created']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $field = $request->input();

            $language = Language::query()->findOrFail($id);
            $language->update([
                'cart_id' => $field['cart_id'],
                'quantity' => $field['quantity'],
                'customer_id' => $field['customer_id'],
                'order_date' => $field['order_date'],
                'address' => $field['address'],
                'status' => $field['status'],
                'payment' => $field['payment'],
            ]);

            if ($language->save())
            {
                return response()->json(['message' => 'Order update successfully']);
            }

            return response()->json(['error' => 'Order not update']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            $field = $request->input();

            $language = Language::query()->findOrFail($id);

            if ($language->delete())
            {
                return response()->json(['message' => 'Order deleted successfully']);
            }

            return response()->json(['error' => 'Order not deleted']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
