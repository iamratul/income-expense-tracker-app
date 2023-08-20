<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function ExpenseCategoryPage()
    {
        return view('pages.dashboard.expense-category-page');
    }

    public function ExpenseCategoryList(Request $request)
    {
        $user_id = $request->header('id');
        return ExpenseCategory::where('user_id', $user_id)->get();
    }

    public function CreateExpenseCategory(Request $request)
    {
        $user_id = $request->header('id');
        return ExpenseCategory::create([
            'name' => $request->input('name'),
            'user_id' => $user_id
        ]);
    }

    public function UpdateExpenseCategory(Request $request)
    {
        $category_id = $request->input('id');
        $user_id = $request->header('id');
        return ExpenseCategory::where('user_id', $user_id)->where('id', $category_id)->update([
            'name' => $request->input('name'),
        ]);
    }

    public function DeleteExpenseCategory(Request $request)
    {
        $category_id = $request->input('id');
        $user_id = $request->header('id');
        return ExpenseCategory::where('id', $category_id)->where('user_id', $user_id)->delete();
    }

    public function ExpenseCategoryById(Request $request)
    {
        $category_id = $request->input('id');
        $user_id = $request->header('id');
        return ExpenseCategory::where('id', $category_id)->where('user_id', $user_id)->first();
    }
}
