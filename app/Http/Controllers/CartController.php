<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Mockery\Exception;

class CartController extends Controller
{
    public function index()
    {
        return Cart::all();
    }

    public function getCartsById(Request $request, $id) {
        try {
            $carts = Cart::query()->where('user_id', '=', $id)->get();

            if (!$carts) {
                return response()->json(['message' => 'Not found carts associate with this userId']);
            }

            return response()->json(['message' => 'Cart finds successfully', 'data' => $carts]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $field = $request->input();

            $language = new Cart();
            $language->fill([
                'user_id' => $field['user_id'],
                'book_id' => $field['book_id'],
                'total_books' => $field['total_books'],
                'total_price' => $field['total_price'],
                'discount' => $field['discount'],
            ]);

            if ($language->save())
            {
                return response()->json(['message' => 'Cart created successfully']);
            }

            return response()->json(['error' => 'Cart not created']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $field = $request->input();

            $language = Cart::query()->findOrFail($id);
            $language->update([
                'user_id' => $field['user_id'],
                'book_id' => $field['book_id'],
                'total_books' => $field['total_books'],
                'total_price' => $field['total_price'],
                'discount' => $field['discount'],
            ]);

            if ($language->save())
            {
                return response()->json(['message' => 'Cart update successfully']);
            }

            return response()->json(['error' => 'Cart not update']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            $field = $request->input();

            $language = Cart::query()->findOrFail($id);

            if ($language->delete())
            {
                return response()->json(['message' => 'Cart deleted successfully']);
            }

            return response()->json(['error' => 'Cart not deleted']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
