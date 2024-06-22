<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return Notification::all();
    }

    public function getAllNotificationsByUser(Request $request, $id): JsonResponse
    {
        try {
            $notification = Notification::query()->where('user_id', '=', $id)->get();

            if (!$notification) {
                return response()->json(['message' => 'Not found Notification associate with this userId']);
            }

            return response()->json(['message' => 'Notifications find successfully', 'data' => $notification]);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $field = $request->input();

            $notification = new Notification();
            $notification->fill([
                'user_id' => $field['user_id'],
                'message' => $field['message'],
            ]);

            if ($notification->save())
            {
                return response()->json(['message' => 'Notification add successfully']);
            }

            return response()->json(['error' => 'error during add notification']);
        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $field = $request->input();

            $notification = Notification::query()->findOrFail($id);
            $notification->update([
                'message' => $field['message'],
            ]);

            if ($notification->save())
            {
                return response()->json(['message' => 'Notification update successfully']);

            return response()->json(['error' => 'Notification not update']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            $field = $request->input();

            $notification = Notification::query()->findOrFail($id);

            if ($notification->delete())
            {
                return response()->json(['message' => 'Notification deleted successfully']);
            }
        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
