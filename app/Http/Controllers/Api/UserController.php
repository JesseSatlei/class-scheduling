<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $allUsers = User::paginate(5);
        if (!$allUsers) {
            return response(['error' => 'There is no user']);
        }
        return response()->json($allUsers);
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->type = $request->type;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->save();

        return response()->json($user);
    }

    public function show($id)
    {
        $user = User::where('id', '=', (int)$id)->first();
        if (!$user) {
            return response(['error' => 'User not found']);
        }
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', '=', (int)$id)->first();
        if (!$user) {
            return response(['error' => 'User not found']);
        }

        $user->type = $request->type;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->save();

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::where('id', '=', (int)$id)->first();
        if (!$user) {
            return response(['error' => 'User not found']);
        }
        $user->delete();
        return response()->json(['sucess' => 'User deleted']);
    }
}
