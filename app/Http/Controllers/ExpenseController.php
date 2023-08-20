<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function ExpensePage()
    {
        return view('pages.dashboard.expense-page');
    }

    public function CreateExpense(Request $request)
    {
        $user_id = $request->header('id');
        return Expense::create([
            'user_id' => $user_id,
            'category_id' => $request->input('category_id'),
            'amount' => $request->input('amount'),
            'description' => $request->input('description'),
            'date' => $request->input('date')
        ]);
    }

    public function ExpenseList(Request $request)
    {
        $user_id = $request->header('id');
        return Expense::with('category')->where('user_id', $user_id)->get();
    }

    public function UpdateExpense(Request $request)
    {
        $expense_id = $request->input('id');
        $user_id = $request->header('id');
        return Expense::where('user_id', $user_id)->where('id', $expense_id)->update([
            'category_id' => $request->input('category_id'),
            'amount' => $request->input('amount'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
        ]);
    }

    public function DeleteExpense(Request $request)
    {
        $expense_id = $request->input('id');
        $user_id = $request->header('id');
        return Expense::where('id', $expense_id)->where('user_id', $user_id)->delete();
    }

    public function ExpenseById(Request $request)
    {
        $expense_id = $request->input('id');
        $user_id = $request->header('id');
        return Expense::where('id', $expense_id)->where('user_id', $user_id)->first();
    }

    public function TotalExpense(Request $request)
    {
        $user_id = $request->header('id');
        $totalExpense = Expense::where('user_id', $user_id)->sum('amount');
        return response()->json(['totalExpense' => $totalExpense]);
    }
}
