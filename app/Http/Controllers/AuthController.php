<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Client;
use function response;


/**
 * @version 1.0.0
 */
class AuthController extends Controller
{
    /**
     * The client access result.
     *
     * @since 1.0.0
     *
     * @var string
     */
    private $client;

    /**
     * Construct method which call when an instance has been created.
     *
     * @since 1.0.0
     *
     */
    public function __construct()
    {
        $this->client = Client::query()->where('password_client', true)->orderBy('id', 'desc')->first();
    }

    /**
     * Register new user.
     *
     * @since 1.0.0
     *
     */
    public function register(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'firstName' => 'string|required',
                'lastName' => 'string|required',
                'email' => 'email|required|unique:users',
                'password' => 'string|required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 500);
            }

            $user = new User();

            $user->fill([
                'city_id' => $request->city_id,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'user_address' => $request->user_address,
                'phone_number' => $request->phone_number,
                'role' => $request->role,
                'email' => $request->email,
            ]);

            $user->password = Hash::make($request->password);

            if ($user->save()) {
                return response()->json(['message' => 'User has been registered successfully ' . $user ], 201);
            }

            return response()->json(['error' => 'User not created'], 422);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Login user.
     *
     * @since 1.0.0
     *
     * @todo Improve better way for login
     *
     */
    public function login(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'email|required',
                'password' => 'string|required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 500);
            }

            $user = User::query()->where('email', $request->email)->first();
            if ($user) {

                if (Hash::check($request->password, $user->password)) {

                    $params = [
                        'grant_type' => 'password',
                        'client_id' => $this->client->id,
                        'client_secret' => $this->client->secret,
                        'username' => $request->email,
                        'password' => $request->password,
                        'scope' => '*'
                    ];

                    $proxy = Request::create('oauth/token', 'POST', $params);

                    $oauth = app()->handle($proxy);
                    $data =  json_decode($oauth->getContent(), true);



                    return response()->json(['message' => $data], 200);
                }
            }

            return response()->json(['error' => 'Unauthenticated'], 401);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Exchange a refresh token for an access token when the access token has expired.
     *
     * @since 1.0.0
     *
     * @todo Improve better way for requesting refresh token
     *
     */
    public function refresh(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'refresh_token' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->getMessages()], 422);
            }

            $params = [
                'grant_type' => 'refresh_token',
                'refresh_token' => $request->refresh_token,
                'client_id' => $this->client->id,
                'client_secret' => $this->client->secret,
                'scope' => ''
            ];
            $proxy = Request::create('oauth/token', 'POST', $params);
            $oauth = app()->handle($proxy);
            $data =  json_decode($oauth->getContent(), true);

            return response()->json(['message' => $data], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Logout from current user.
     *
     * @since 1.0.0
     *
     * @todo Improve better way for logout
     *
     */
    public function logout(): JsonResponse
    {
        try {
            $accessToken = auth()->guard()->user()->token();
            DB::table('oauth_refresh_tokens')->where('access_token_id', $accessToken->id)->update(['revoked' => true]);
            if ($accessToken->revoke()) {
                return response()->json(['message' => 'User has been logout successfully'], 204);
            }
            return response()->json(['error' => 'User not logout'], 422);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
