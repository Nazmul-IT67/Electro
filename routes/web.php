<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductsController;

/*
| Web Routes
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('home',[AuthController::class, 'Dashboard'])->name('Dashboard')->middleware('islogin');
Route::get('logout',[AuthController::class,'LogOut'])->name('LogOut');
//--------------------------------------------------------------------------------------------------//
Route::get('register',[AuthController::class, 'Register'])->name('Register')->middleware('alrarylogin');
Route::post('register-post',[AuthController::class, 'RegisterPost'])->name('RegisterPost');
Route::get('login',[AuthController::class, 'Login'])->name('Login')->middleware('alrarylogin');
Route::post('login-post',[AuthController::class, 'LoginPost'])->name('LoginPost');
//---------------------------------------------------------------------------------------//
Route::get('forgatepass',[AuthController::class, 'ForgatePass'])->name('ForgatePass');
Route::post('password-link',[AuthController::class, 'PasswordLink'])->name('PasswordLink');
Route::get('reset-from',[AuthController::class, 'ResetPassget'])->name('ResetPassget');
Route::post('pass-update',[AuthController::class, 'UpdatePass'])->name('UpdatePass');
//------------------------------------------------------------------------------------//
Route::get('add-category', [CategoryController::class, 'AddCategory'])->name('AddCategory');
Route::POST('category', [CategoryController::class, 'CategoryPost'])->name('CategoryPost');
Route::get('category-list', [CategoryController::class, 'CategoryList'])->name('CategoryList');
Route::get('category-edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('CategoryEdit');
Route::POST('category-update', [CategoryController::class, 'CategoryUpdate'])->name('CategoryUpdate');
Route::get('category-trash/{id}', [CategoryController::class, 'CategoryTrash'])->name('CategoryTrash');
Route::get('trashlist', [CategoryController::class, 'CategoryTrashList'])->name('CategoryTrashList');
Route::get('restor/{id}', [CategoryController::class, 'Restor'])->name('Restor');
Route::get('delete/{id}', [CategoryController::class, 'Delete'])->name('Delete');
//------------------------------------------------------------------------------------//
Route::get('subcategory-add', [SubCategoryController::class, 'SubCategory'])->name('SubCategory');
Route::POST('subcategory', [SubCategoryController::class, 'SubCategoryPost'])->name('SubCategoryPost');
Route::get('subcategory-list', [SubCategoryController::class, 'SubCategoryList'])->name('SubCategoryList');
Route::get('subcategory-edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('SubCategoryEdit');
Route::POST('update-data', [SubCategoryController::class, 'UpdateData'])->name('UpdateData');
Route::get('subcategory-delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('SubCategoryDelete');
Route::get('trash-data', [SubCategoryController::class, 'TrashData'])->name('TrashData');
Route::get('undo-data/{id}', [SubCategoryController::class, 'UndoData'])->name('UndoData');
Route::get('delete-data/{id}', [SubCategoryController::class, 'DeleteData'])->name('DeleteData');
//----------------------------------------------------------------------------------------------//
Route::get('product-add', [ProductsController::class, 'AddProduct'])->name('AddProduct');
Route::get('product-insert', [ProductsController::class, 'InsertProduct'])->name('InsertProduct');
Route::get('product-list', [ProductsController::class, 'ProductList'])->name('ProductList');
Route::get('trash-product', [ProductsController::class, 'TrashProduct'])->name('TrashProduct');
Route::get('sub-cat/{id}', [ProductsController::class, 'SubCat'])->name('SubCat');
