<?php

namespace App\Http\Controllers;

use App\Models\IncomeCategory;
use Illuminate\Http\Request;

class IncomeCategoryController extends Controller
{
    public function IncomeCategoryPage()
    {
        return view('pages.dashboard.income-category-page');
    }

    public function IncomeCategoryList(Request $request)
    {
        $user_id = $request->header('id');
        return IncomeCategory::where('user_id', $user_id)->get();
    }

    public function IncomeCategoryCreate(Request $request)
    {
        $user_id = $request->header('id');
        return IncomeCategory::create([
            'name' => $request->input('name'),
            'user_id' => $user_id
        ]);
    }

    public function IncomeCategoryUpdate(Request $request)
    {
        $category_id = $request->input('id');
        $user_id = $request->header('id');
        return IncomeCategory::where('user_id', $user_id)->where('id', $category_id)->update([
            'name' => $request->input('name'),
        ]);
    }

    public function IncomeCategoryDelete(Request $request)
    {
        $category_id = $request->input('id');
        $user_id = $request->header('id');
        return IncomeCategory::where('id', $category_id)->where('user_id', $user_id)->delete();
    }

    public function IncomeCategoryById(Request $request)
    {
        $category_id = $request->input('id');
        $user_id = $request->header('id');
        return IncomeCategory::where('id', $category_id)->where('user_id', $user_id)->first();
    }
}
