<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Laravel\Lumen\Routing\Controller;
use PHPUnit\Exception;

class ReviewController extends Controller
{
    public function index()
    {
        return Review::all();
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $fields = $request->input();

            $review = new Review();
            $review->fill([
                'review_id' => $fields['review_id'],
                'customer_id' => $fields['customer_id'],
                'review_book_id' => $fields['review_book_id'],
                'review' => $fields['review'],
            ]);

            if ($review->save())
            {
                return response()->json(['message' => 'Review created successfully']);
            }

            return response()->json(['error' => 'Review fail to create']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $fields = $request->input();

            $review = Review::query()->findOrFail($id);
            $review->update([
                'review_id' => $fields['review_id'],
                'customer_id' => $fields['customer_id'],
                'review_book_id' => $fields['review_book_id'],
                'review' => $fields['review'],
            ]);

            if ($review->save())
            {
                return response()->json(['message' => 'Review update successfully']);
            }

            return response()->json(['error' => 'Review fail to update']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            $review = Review::query()->findOrFail($id);

            if ($review->delete())
            {
                return response()->json(['message' => 'Review deleted successfully']);
            }

            return response()->json(['error' => 'Review fail to delete']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
