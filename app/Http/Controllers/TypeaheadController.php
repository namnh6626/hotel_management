<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeaheadController extends Controller
{
    public function autocompleteSearch(Request $request)
    {
          $query = $request->get('query');
        //   $filterResult = User::where('phone', 'LIKE', '%'. $query.'%')->get();
        $filterResult = DB::table('customers')->where('phone', 'LIKE', '%'.$query.'%')->orWhere('citizen_id', 'LIKE', '%'.$query.'%')->get();
          return response()->json($filterResult);
    }

    public function searchUser(Request $request){
        $query = $request->get('query');
        $filterResult = DB::table('users')
                        ->where('phone', 'LIKE', '%'.$query.'%')
                        ->orWhere('user_email', 'LIKE', '%'.$query.'%')
                        ->orWhere('user_name', 'LIKE', '%'.$query.'%')
                        ->get();
        return response()->json($filterResult);
    }
}
