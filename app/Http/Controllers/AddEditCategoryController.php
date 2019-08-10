<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\Http\Requests\AddEditCategoryRequest;

class AddEditCategoryController extends Controller
{

    public function addCategory(Request $request)
    {
        return view("add_edit_category");
    }

    public function doAddCategory(AddEditCategoryRequest $request)
    {
        $checkCategoryName = Category::whereRaw("category_name = ? AND user_id = ?", [$request->get("category_name"), session("user_id")])->get()->Count();
        if ($checkCategoryName == 0) {
            Category::insert(array("category_name" => $request->get("category_name"), "category_type" => $request->get("category_type"), "user_id" => session("user_id") ));
            return redirect(url('admin/category?mess=add_category-success'));
        } else
            return redirect(url('admin/category/add?err=category_name-exists'));
    }

    public function editCategory(Request $request, $id)
    {
        $data["record"] = Category::find($id);
        return view("add_edit_category", $data);
    }

    public function doEditCategory(AddEditCategoryRequest $request, $id)
    {
        $checkCategoryName = Category::whereRaw("id <> ? AND category_name = ? AND user_id = ?", [$id, $request->get("category_name"), session("user_id")])->get()->Count();
        if ($checkCategoryName == 0) {
            Category::where("id", "=", $id)->update(array("category_name" => $request->get("category_name"), "category_type" => $request->get("category_type"), "user_id" => session("user_id") ));
            return redirect(url('admin/category?mess=edit_category-success'));
        } else
            return redirect(url('admin/category/edit/' . $id . '?err=category_name-exists'));
    }
}
