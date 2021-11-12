<?php

namespace App\Http\Controllers;

use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
  public function getListOfRoles(Request $request)
  {
      try {
          $limit = intval($request->query('limit', 20));
          $offset = intval($request->query('offset', 0));


          $roles = Role::query();
          $roles_count = $roles->count();
          $roles = $roles->skip($offset)
              ->take($limit)
              ->get();

          $previous_offset = $offset - $limit;
          if ($previous_offset < 0) $previous_offset = 0;
          $next_offset = $offset + $limit;
          $next_url = $request->fullUrlWithQuery(['limit' => $limit, 'offset' => $next_offset]);
          $previous_url = $request->fullUrlWithQuery(['limit' => $limit, 'offset' => $previous_offset]);
          if ($offset + $limit > $roles_count) $next_url = null;
          if ($offset - $limit < 0) $previous_url = null;

          return response()->json(array(
              'total_role' => $roles_count,
              'role_list' => $roles,
              'next_url' => $next_url,
              'previous_url' => $previous_url,
          ), 200);

      }catch (\Exception $exception){
          return response()->json(array('message' => $exception->getMessage()), 500);
      }

  }

    public function createRole(Request $request)
    {
        try {

            $this->validate($request, [
                'role_name' => 'required',
            ]);

            $role = Role::firstOrCreate(
                ['role_name' => $request->role_name]
            );

            if ($role) {
                return response()->json(['message' => 'Role created'], 200);
            }
        }catch (\Exception $exception){
            return response()->json(array('message' => $exception->getMessage()), 500);
        }

    }

    public function deleteRole(Request $request)

    {
        try{
        DB::table("roles")->where('id',$request->id)->delete();

        return response()->json(['message'=>'Role deleted successfully'], 200);
        }
        catch (\Exception $exception)
        {
            return response()->json(array('message' => $exception->getMessage()), 500);
        }

    }

    public function assignRole(Request $request)
    {
        try {
        $validatedData = $request->validate([
            'user_id' => ['required'],
            'role_id' => ['required'],
        ]);

        $role_id = $request->role_id;
        $user_id = $request->user_id;

        $role = Role::findOrFail($role_id);

        $user = User::findOrFail($user_id);


        $checkSameRoleExist = DB::table('role_user')->where('user_id','=',$user_id)->first();

        if(empty($checkSameRoleExist))
        {
            $user->roles()->attach($role->id);
            return response()->json(array('message' => 'New Role Assigned','error'=> false), 200);
        }
        }catch(\Exception $exception){
//            return response()->json(['message'=>'failure'], 500);
            return response()->json(array('message' => $exception->getMessage()), 500);
        }

    }

    public function deleteAssignedRole(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'role_id' => 'required|exists:roles,id',
            ]);

            if ($validator->fails()) {
                return response()->json(array('message' => $validator->errors()), 422);
            }

            $role_id = $request->role_id;
            $user_id = $request->user_id;

            $user = User::findOrFail($user_id);

            $user->roles()->detach($request->role_id);
            return response()->json(array('message' => 'Assigned Role Deleted','error'=> false), 200);
        }
        catch (\Exception $exception){
            return response()->json(array('message' => $exception->getMessage()), 500);
    }

    }
}
