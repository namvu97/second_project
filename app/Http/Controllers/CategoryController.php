<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\Http\Requests\AddEditCategoryRequest;

class CategoryController extends Controller
{

    public function listCategory()
    {
        $data["arr"] = Category::where("user_id", session("user_id"))->orderBy("id", "desc")->paginate(4);
        return view("list_category", $data);
    }

    public function deleteCategory(Request $request, $id)
    {
        Category::destroy($id);
        return redirect(url('admin/category'));
    }
}
