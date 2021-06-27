<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{

    public function index()
    {
        $allPermission = Permission::paginate(5);
        if (!$allPermission) {
            return response(['error' => 'There is no permission']);
        }
        return response()->json($allPermission);
    }

    public function store(Request $request)
    {
        $permission = new Permission;
        $permission->type_permission = $request->type_permission;
        $permission->type_user = $request->type_user;
        $permission->route = $request->route;
        $permission->save();

        return response()->json($permission);
    }

    public function show($id)
    {
        $permission = Permission::where('id', '=', (int)$id)->first();
        if (!$permission) {
            return response(['error' => 'Permission not found']);
        }
        return response()->json($permission);
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::where('id', '=', (int)$id)->first();
        if (!$permission) {
            return response(['error' => 'Permission not found']);
        }
        $permission->type_permission = $request->type_permission;
        $permission->type_user = $request->type_user;
        $permission->route = $request->route;
        $permission->save();

        return response()->json($permission);
    }

    public function destroy($id)
    {
        $permission = Permission::where('id', '=', (int)$id)->first();
        if (!$permission) {
            return response(['error' => 'Permission not found']);
        }
        $permission->delete();
        return response()->json(['sucess' => 'Permission deleted']);
    }
}
