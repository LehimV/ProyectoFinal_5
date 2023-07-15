<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class CategoryController extends Controller
{
  public function index()
  {
    $categories = Category::all();
    return view('categories.index', ['categories' => $categories]);
  }



  public function get_items()
  {
    $categories = Category::with('items')->get();
    return view('categories.items', ['categories' => $categories]);
  }

  public function create()
  {
    return view('categories.create');
  }

  public function store(Request $request)
  {
    $category = new Category;
    $category->name = $request->input('name');
    $category->save();

    return redirect()->route('categories.index');
  }

  public function show($id)
  {
    $category = Category::findOrFail($id);
    return view('categories.show', ['category' => $category]);
  }

  public function find_by_name(Request $request)
  {
    $category = Category::where('name', '=', $request->input('name'))->first();
    return view('categories.show', ['category' => $category]);
  }

  public function edit($id)
  {
    $category = Category::findOrFail($id);
    return view('categories.edit', ['category' => $category]);
  }

  public function update(Request $request, $id)
  {
    $category = Category::findOrFail($id);
    $category->name = $request->input('name');
    $category->save();

    return redirect()->route('categories.index');
  }

  public function destroy($id)
  {
    $category = Category::findOrFail($id);
    $category->delete();

    return redirect()->route('categories.index');
  }
}
