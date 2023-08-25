<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;

class Inquiry extends Controller
{
    function saveinquiry(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            $value = [
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'added_datetime' => date('Y-m-d H:i:s'),
            ];

            $query = DB::table('inquiry')->insert($value);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Inquiry has been succeessfully added']);
            }
        }
    }
    
    function fetchInquiry(Request $request) {
        $query = DB::table('inquiry');

        if (!empty($request->search)) {
            $query->orWhere('name', 'LIKE', "{$request->search}%");
        }
        $allCategory = $query->get();
        $categoryCount = $allCategory->count();

        $query = DB::table('inquiry');

        if (!empty($request->search)) { 
            $query->orWhere('name', 'LIKE', "{$request->search}%");
        }

        if (!empty($request->sort)) { 
            $query->orderBy('id', $request->sort);
        }
        $query->offset($request->offset);
        $query->limit($request->limit);
        $category = $query->get();

        return response()->json(['status' => true, 'data' => $category, 'totalPage' => Ceil($categoryCount/$request->limit) ]);
    }
}
