<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;

class Category extends Controller
{

    public function saveCategory(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required',
            '_token' => 'required',
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
                'slug' => $request->slug,
                'isActive' => $request->isActive,
                'added_datetime' => date('Y-m-d H:i:s'),
            ];

            $query = DB::table('category')->insert($value);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Category has been succeessfully added']);
            }
        }
    }

    function fetchCategory(Request $request) {
        $query = DB::table('category');

        if (!empty($request->search)) {
            $query->orWhere('name', 'LIKE', "{$request->search}%")->orWhere('slug', 'LIKE', "{$request->search}%");
        }
        $allCategory = $query->get();
        $categoryCount = $allCategory->count();

        $query = DB::table('category');
        if (!empty($request->search)) { 
            $query->orWhere('name', 'LIKE', "{$request->search}%")->orWhere('slug', 'LIKE', "{$request->search}%");
        }

        if (!empty($request->sort)) { 
            $query->orderBy('id', $request->sort);
        }
        $query->offset($request->offset);
        $query->limit($request->limit);
        $category = $query->get();

        return response()->json(['status' => true, 'data' => $category, 'totalPage' => Ceil($categoryCount/$request->limit) ]);
    }

    function updateCategory(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required',
            '_token' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            try {
                $query = DB::table('category')
                ->where('id', $request->editId)
                ->update([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'isActive' => $request->isActive
                    ]);

                if ($query) {
                    return response()->json(['status' => true, 'message' => 'Category has been succeessfully updated']);
                }
            } catch (\Illuminate\Database\QueryException $e) {
                dd($e->getMessage());
            }
            
        }
    }

    public function subCategory() {
        $query = DB::table('category');
        $query->where('isActive', '=', '1');
        $category = $query->get();
        return view('backend.subCategory')->with('category', $category);
    }

    function saveSubCategory(Request $request) {
        $validator = Validator::make($request->all(),[
            'categoryId' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'isActive' => 'required',
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
                'category_id' => $request->categoryId,
                'name' => $request->name,
                'slug' => $request->slug,
                'isActive' => $request->isActive,
                'added_datetime' => date('Y-m-d H:i:s'),
            ];

            $query = DB::table('sub_category')->insert($value);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Sub Category has been succeessfully added']);
            }
        }
    }

    function fetchSubCategory(Request $request) {
        $query = DB::table('sub_category')
                ->join('category', 'category.id', '=', 'sub_category.category_id');

        if (!empty($request->mainCategoryId)) {
            $query->where("category_id", "=", $request->mainCategoryId);
        }

        if (!empty($request->search)) {
            $query->orWhere('sub_category.name', 'LIKE', "{$request->search}%")->orWhere('sub_category.slug', 'LIKE', "{$request->search}%")->orWhere('category.name', 'LIKE', "{$request->search}%");
        }
        $allCategory = $query->get();
        $categoryCount = $allCategory->count();

        $query = DB::table('sub_category')
            ->select('sub_category.id','sub_category.name', 'sub_category.slug', 'sub_category.isActive', 'category.name as category_name', 'category_id')
            ->join('category', 'category.id', '=', 'sub_category.category_id');
            
        if (!empty($request->mainCategoryId)) {
            $query->where("category_id", "=", $request->mainCategoryId);
        }

        if (!empty($request->search)) { 
            $query->orWhere('sub_category.name', 'LIKE', "{$request->search}%")->orWhere('sub_category.slug', 'LIKE', "{$request->search}%")->orWhere('category.name', 'LIKE', "{$request->search}%");
        }

        if (!empty($request->sort)) { 
            $query->orderBy('sub_category.id', $request->sort);
        }
        $query->offset($request->offset);
        $query->limit($request->limit);
        $category = $query->get();

        return response()->json(['status' => true, 'data' => $category, 'totalPage' => Ceil($categoryCount/$request->limit) ]);
    }

    function updateSubCategory(Request $request) {
        $validator = Validator::make($request->all(),[
            'categoryId' => 'required',
            'name' => 'required',
            'slug' => 'required',
            '_token' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            try {
                $query = DB::table('sub_category')
                ->where('id', $request->editId)
                ->update([
                    'category_id' => $request->categoryId,
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'isActive' => $request->isActive
                    ]);

                if ($query) {
                    return response()->json(['status' => true, 'message' => 'Sub Category has been succeessfully updated']);
                }
            } catch (\Illuminate\Database\QueryException $e) {
                dd($e->getMessage());
            }
            
        }
    }

    function fetchFabric(Request $request) {
        $query = DB::table('fabric');

        if (!empty($request->search)) {
            $query->orWhere('name', 'LIKE', "{$request->search}%");
        }
        $allCategory = $query->get();
        $categoryCount = $allCategory->count();

        $query = DB::table('fabric');

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

    function saveFabric(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'isActive' => 'required',
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
                'isActive' => $request->isActive,
                'added_datetime' => date('Y-m-d H:i:s'),
            ];

            $query = DB::table('fabric')->insert($value);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Fabric has been succeessfully added']);
            }
        }
    }

    function updateFabric(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            '_token' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            $query = DB::table('fabric')
            ->where('id', $request->editId)
            ->update([
                'name' => $request->name,
                'isActive' => $request->isActive
                ]);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Fabric has been succeessfully updated']);
            }
        }
    }

    function fetchColor(Request $request) {
        $query = DB::table('color');

        if (!empty($request->search)) {
            $query->orWhere('name', 'LIKE', "{$request->search}%");
        }
        $allCategory = $query->get();
        $categoryCount = $allCategory->count();

        $query = DB::table('color');

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

    function saveColor(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'color' => 'required',
            'isActive' => 'required',
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
                'color_code' => $request->color,
                'isActive' => $request->isActive,
                'added_datetime' => date('Y-m-d H:i:s'),
            ];

            $query = DB::table('color')->insert($value);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Color has been succeessfully added']);
            }
        }
    }

    function updateColor(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'color' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            $query = DB::table('color')
            ->where('id', $request->editId)
            ->update([
                'name' => $request->name,
                'color_code' => $request->color,
                'isActive' => $request->isActive
                ]);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Color has been succeessfully updated']);
            }
        }
    }

    function fetchSize(Request $request) {
        $query = DB::table('size');

        if (!empty($request->search)) {
            $query->orWhere('name', 'LIKE', "{$request->search}%");
        }
        $allCategory = $query->get();
        $categoryCount = $allCategory->count();

        $query = DB::table('size');

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

    function saveSize(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'isActive' => 'required',
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
                'isActive' => $request->isActive,
                'added_datetime' => date('Y-m-d H:i:s'),
            ];

            $query = DB::table('size')->insert($value);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Size has been succeessfully added']);
            }
        }
    }

    function updateSize(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            $query = DB::table('size')
            ->where('id', $request->editId)
            ->update([
                'name' => $request->name,
                'isActive' => $request->isActive
                ]);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Size has been succeessfully updated']);
            }
        }
    }

     function fetchinquiry(Request $request) {
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

     function fetchcustomer(Request $request) {
        $query = DB::table('users');

        if (!empty($request->search)) {
            $query->orWhere('name', 'LIKE', "{$request->search}%");
        }
        $query->where([['role', '=', 'role']]);
        $allCategory = $query->get();
        $categoryCount = $allCategory->count();

        $query = DB::table('users');

        if (!empty($request->search)) { 
            $query->orWhere('name', 'LIKE', "{$request->search}%");
        }

        $query->where([['role', '=', 'user']]);

        if (!empty($request->sort)) { 
            $query->orderBy('id', $request->sort);
        }
        $query->offset($request->offset);
        $query->limit($request->limit);
        $category = $query->get();

        return response()->json(['status' => true, 'data' => $category, 'totalPage' => Ceil($categoryCount/$request->limit) ]);
    }

    function deleteColorImg(Request $request) {
        if ($request->has('colorImgId')) {
            $query = DB::table('product_img')->where([['id','=', $request->colorImgId]])->delete();

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Color image has been successfully deleted']);
            } else {
                return response()->json(['status' => false, 'message' => "Color image cannot be deleted, please contact admin"]);
            }
        }

        return response()->json(['status' => false, 'message' => 'Color Imges ID is required']);
    }

    function deleteAllColorImg(Request $request) {
        if (!$request->has('productId')) {
            return response()->json(['status' => false, 'message' => 'Product ID is required']);
        }

        if (!$request->has('colorId')) {
            return response()->json(['status' => false, 'message' => 'Color ID is required']);
        }

        $query = DB::table('product_img')->where([['product_id','=', $request->productId], ['color_id', '=', $request->colorId]])->delete();

        if ($query) {
            $productData = DB::table('product')->where([['id','=', $request->productId]])->first();

            $ColorIds = explode(',', $productData->color_id);
            $key = array_search($request->colorId, $ColorIds, true);
            if ($key !== false) {
                unset($ColorIds[$key]);
                DB::table('product')->where([['id','=', $request->productId]])->update(['color_id' => implode(',', $ColorIds)]);
            }

            return response()->json(['status' => true, 'message' => 'Color has been successfully deleted']);
        } else {
            return response()->json(['status' => true, 'message' => "Color cannot be deleted, please contact admin"]);
        }

    }

    function fetchOccasion(Request $request) {
        $query = DB::table('occasion');

        if (!empty($request->search)) {
            $query->orWhere('name', 'LIKE', "{$request->search}%");
        }
        $allCategory = $query->get();
        $categoryCount = $allCategory->count();

        $query = DB::table('occasion');

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

    function saveOccasion(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'isActive' => 'required',
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
                'isActive' => $request->isActive,
                'added_datetime' => date('Y-m-d H:i:s'),
            ];

            $query = DB::table('occasion')->insert($value);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Occasion has been succeessfully added']);
            }
        }
    }

    function updateOccasion(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            $query = DB::table('occasion')
            ->where('id', $request->editId)
            ->update([
                'name' => $request->name,
                'isActive' => $request->isActive
                ]);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Occasion has been succeessfully updated']);
            }
        }
    }

    function fetchPattern(Request $request) {
        $query = DB::table('pattern');

        if (!empty($request->search)) {
            $query->orWhere('name', 'LIKE', "{$request->search}%");
        }
        $allCategory = $query->get();
        $categoryCount = $allCategory->count();

        $query = DB::table('pattern');

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

    function savePattern(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'isActive' => 'required',
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
                'isActive' => $request->isActive,
                'added_datetime' => date('Y-m-d H:i:s'),
            ];

            $query = DB::table('pattern')->insert($value);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Pattern has been succeessfully added']);
            }
        }
    }

    function updatePattern(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            $query = DB::table('pattern')
            ->where('id', $request->editId)
            ->update([
                'name' => $request->name,
                'isActive' => $request->isActive
                ]);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Pattern has been succeessfully updated']);
            }
        }
    }
    
    function fetchWork(Request $request) {
        $query = DB::table('work');

        if (!empty($request->search)) {
            $query->orWhere('name', 'LIKE', "{$request->search}%");
        }
        $allCategory = $query->get();
        $categoryCount = $allCategory->count();

        $query = DB::table('work');

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

    function saveWork(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'isActive' => 'required',
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
                'isActive' => $request->isActive,
                'added_datetime' => date('Y-m-d H:i:s'),
            ];

            $query = DB::table('work')->insert($value);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Work has been succeessfully added']);
            }
        }
    }

    function updateWork(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            $query = DB::table('work')
            ->where('id', $request->editId)
            ->update([
                'name' => $request->name,
                'isActive' => $request->isActive
                ]);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Work has been succeessfully updated']);
            }
        }
    }

    function fetchSleeve(Request $request) {
        $query = DB::table('sleeve_type');

        if (!empty($request->search)) {
            $query->orWhere('name', 'LIKE', "{$request->search}%");
        }
        $allCategory = $query->get();
        $categoryCount = $allCategory->count();

        $query = DB::table('sleeve_type');

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

    function saveSleeve(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'isActive' => 'required',
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
                'isActive' => $request->isActive,
                'added_datetime' => date('Y-m-d H:i:s'),
            ];

            $query = DB::table('sleeve_type')->insert($value);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Sleeve has been succeessfully added']);
            }
        }
    }

    function updateSleeve(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            $query = DB::table('sleeve_type')
            ->where('id', $request->editId)
            ->update([
                'name' => $request->name,
                'isActive' => $request->isActive
                ]);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Sleeve has been succeessfully updated']);
            }
        }
    }

    function fetchWash(Request $request) {
        $query = DB::table('wash');

        if (!empty($request->search)) {
            $query->orWhere('name', 'LIKE', "{$request->search}%");
        }
        $allCategory = $query->get();
        $categoryCount = $allCategory->count();

        $query = DB::table('wash');

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

    function saveWash(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'isActive' => 'required',
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
                'isActive' => $request->isActive,
                'added_datetime' => date('Y-m-d H:i:s'),
            ];

            $query = DB::table('wash')->insert($value);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Wash has been succeessfully added']);
            }
        }
    }

    function updateWash(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            $query = DB::table('wash')
            ->where('id', $request->editId)
            ->update([
                'name' => $request->name,
                'isActive' => $request->isActive
                ]);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Wash has been succeessfully updated']);
            }
        }
    }

    function fetchHook(Request $request) {
        $query = DB::table('hook');

        if (!empty($request->search)) {
            $query->orWhere('name', 'LIKE', "{$request->search}%");
        }
        $allCategory = $query->get();
        $categoryCount = $allCategory->count();

        $query = DB::table('hook');

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

    function saveHook(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'isActive' => 'required',
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
                'isActive' => $request->isActive,
                'added_datetime' => date('Y-m-d H:i:s'),
            ];

            $query = DB::table('hook')->insert($value);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Hook has been succeessfully added']);
            }
        }
    }

    function updateHook(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            $query = DB::table('hook')
            ->where('id', $request->editId)
            ->update([
                'name' => $request->name,
                'isActive' => $request->isActive
                ]);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Hook has been succeessfully updated']);
            }
        }
    }
}
