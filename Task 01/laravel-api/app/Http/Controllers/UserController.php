<?php

namespace App\Http\Controllers;

use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
  public function userProfileInformation($user_id){

      $user = User::with('roles')->find($user_id);
      return response()->json(array(
          'user' => $user
      ), 200);
  }

  public function userList(Request $request){

      try {
          $limit = intval($request->query('limit', 20));
          $offset = intval($request->query('offset', 0));

          $user = User::query();
          $user_count = $user->count();
          $user = $user->skip($offset)
              ->take($limit)
              ->get();

          $previous_offset = $offset - $limit;
          if ($previous_offset < 0) $previous_offset = 0;
          $next_offset = $offset + $limit;
          $next_url = $request->fullUrlWithQuery(['limit' => $limit, 'offset' => $next_offset]);
          $previous_url = $request->fullUrlWithQuery(['limit' => $limit, 'offset' => $previous_offset]);
          if ($offset + $limit > $user_count) $next_url = null;
          if ($offset - $limit < 0) $previous_url = null;

          return response()->json(array(
              'total_user' => $user_count,
              'user_list' => $user,
              'next_url' => $next_url,
              'previous_url' => $previous_url,
          ), 200);
      }
      catch (\Exception $exception){
          return response()->json(array('message' => $exception->getMessage()), 500);
      }
  }
}


