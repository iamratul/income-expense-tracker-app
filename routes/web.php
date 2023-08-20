<?php

use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerifyMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);

// User Logout
Route::get('/logout', [UserController::class, 'UserLogout']);

// Page Route
Route::get('/', [UserController::class, 'LoginPage']);
Route::get('/registration', [UserController::class, 'RegistrationPage']);
Route::get('/dashboard', [UserController::class, 'DashboardPage'])->middleware([TokenVerifyMiddleware::class]);
Route::get('/user-profile-page', [UserController::class, 'ProfilePage'])->middleware([TokenVerifyMiddleware::class]);
Route::get('/user-profile', [UserController::class, 'UserProfile'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/update-user-profile', [UserController::class, 'UpdateUserProfile'])->middleware([TokenVerifyMiddleware::class]);

// Income Category API
Route::get('/income-category', [IncomeCategoryController::class, 'IncomeCategoryPage'])->middleware([TokenVerifyMiddleware::class]);
Route::get('/income-category-list', [IncomeCategoryController::class, 'IncomeCategoryList'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/create-income-category', [IncomeCategoryController::class, 'IncomeCategoryCreate'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/update-income-category', [IncomeCategoryController::class, 'IncomeCategoryUpdate'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/delete-income-category', [IncomeCategoryController::class, 'IncomeCategoryDelete'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/income-category-by-id', [IncomeCategoryController::class, 'IncomeCategoryById'])->middleware([TokenVerifyMiddleware::class]);

// Expense Category API
Route::get('/expense-category', [ExpenseCategoryController::class, 'ExpenseCategoryPage'])->middleware([TokenVerifyMiddleware::class]);
Route::get('/expense-category-list', [ExpenseCategoryController::class, 'ExpenseCategoryList'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/create-expense-category', [ExpenseCategoryController::class, 'CreateExpenseCategory'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/update-expense-category', [ExpenseCategoryController::class, 'UpdateExpenseCategory'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/delete-expense-category', [ExpenseCategoryController::class, 'DeleteExpenseCategory'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/expense-category-by-id', [ExpenseCategoryController::class, 'ExpenseCategoryById'])->middleware([TokenVerifyMiddleware::class]);

// Income API
Route::get('/income', [IncomeController::class, 'IncomePage'])->middleware([TokenVerifyMiddleware::class]);
Route::get('/income-list', [IncomeController::class, 'IncomeList'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/create-income', [IncomeController::class, 'CreateIncome'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/update-income', [IncomeController::class, 'UpdateIncome'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/delete-income', [IncomeController::class, 'DeleteIncome'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/income-by-id', [IncomeController::class, 'IncomeById'])->middleware([TokenVerifyMiddleware::class]);
Route::get('/total-income', [IncomeController::class, 'TotalIncome'])->middleware([TokenVerifyMiddleware::class]);

// Expense API
Route::get('/expense', [ExpenseController::class, 'ExpensePage'])->middleware([TokenVerifyMiddleware::class]);
Route::get('/expense-list', [ExpenseController::class, 'ExpenseList'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/create-expense', [ExpenseController::class, 'CreateExpense'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/update-expense', [ExpenseController::class, 'UpdateExpense'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/delete-expense', [ExpenseController::class, 'DeleteExpense'])->middleware([TokenVerifyMiddleware::class]);
Route::post('/expense-by-id', [ExpenseController::class, 'ExpenseById'])->middleware([TokenVerifyMiddleware::class]);
Route::get('/total-expense', [ExpenseController::class, 'TotalExpense'])->middleware([TokenVerifyMiddleware::class]);