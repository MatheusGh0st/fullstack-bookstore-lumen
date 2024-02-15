<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Mockery\Exception;

class PaymentController extends Controller
{
    public function index()
    {
        return Payment::all();
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $field = $request->input();

            $language = new Payment();
            $language->fill([
                'cart_id' => $field['cart_id'],
                'customer_id' => $field['customer_id'],
                'status' => $field['status'],
                'payment_method' => $field['payment_method'],
            ]);

            if ($language->save())
            {
                return response()->json(['message' => 'Payment created successfully']);
            }

            return response()->json(['error' => 'Payment not created']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $field = $request->input();

            $language = Payment::query()->findOrFail($id);
            $language->update([
                'cart_id' => $field['cart_id'],
                'customer_id' => $field['customer_id'],
                'status' => $field['status'],
                'payment_method' => $field['payment_method'],
            ]);

            if ($language->save())
            {
                return response()->json(['message' => 'Payment update successfully']);
            }

            return response()->json(['error' => 'Payment not update']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            $field = $request->input();

            $language = Payment::query()->findOrFail($id);

            if ($language->delete())
            {
                return response()->json(['message' => 'Payment deleted successfully']);
            }

            return response()->json(['error' => 'Payment not deleted']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
