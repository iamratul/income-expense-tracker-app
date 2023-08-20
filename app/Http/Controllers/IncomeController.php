<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function IncomePage()
    {
        return view('pages.dashboard.income-page');
    }

    public function CreateIncome(Request $request)
    {
        $user_id = $request->header('id');
        return Income::create([
            'user_id' => $user_id,
            'category_id' => $request->input('category_id'),
            'amount' => $request->input('amount'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
        ]);
    }

    public function IncomeList(Request $request)
    {
        $user_id = $request->header('id');
        $query = Income::with('category')->where('user_id', $user_id);

        // Apply filters
        if ($request->has('category')) {
            $query->where('category_id', $request->input('category'));
        }

        if ($request->has('fromDate') && $request->has('toDate')) {
            $fromDate = $request->input('fromDate');
            $toDate = $request->input('toDate');
            $query->whereBetween('date', [$fromDate, $toDate]);
        }

        // Apply sorting
        if ($request->has('sort')) {
            list($sortColumn, $sortDirection) = explode('-', $request->input('sort'));
            $query->orderBy($sortColumn, $sortDirection);
        }

        $data = $query->get();
        return response()->json($data);
    }

    public function UpdateIncome(Request $request)
    {
        $income_id = $request->input('id');
        $user_id = $request->header('id');
        return Income::where('user_id', $user_id)->where('id', $income_id)->update([
            'category_id' => $request->input('category_id'),
            'amount' => $request->input('amount'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
        ]);
    }

    public function DeleteIncome(Request $request)
    {
        $income_id = $request->input('id');
        $user_id = $request->header('id');
        return Income::where('id', $income_id)->where('user_id', $user_id)->delete();
    }

    public function IncomeById(Request $request)
    {
        $income_id = $request->input('id');
        $user_id = $request->header('id');
        return Income::where('id', $income_id)->where('user_id', $user_id)->first();
    }

    public function TotalIncome(Request $request)
    {
        $user_id = $request->header('id');
        $totalIncome = Income::where('user_id', $user_id)->sum('amount');
        return response()->json(['totalIncome' => $totalIncome]);
    }
}
