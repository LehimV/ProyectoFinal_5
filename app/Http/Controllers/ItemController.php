<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
  public function index()
  {
    $items = Item::all()->sortBy('category_id');
    return view('items/index', compact('items'));

    /*$firstEightItems = $items->take(8);
    $lastFourItems = $items->skip(8)->take(4);

    return view('items.index', compact('items', 'firstEightItems', 'lastFourItems'));*/
  }


  public function create()
  {
    $categories = Category::all();
    return view('items/create', ['categories' => $categories]);
  }

  public function get_top_items_categories()
  {
    $all_items_in_list = DB::table('item_list')->count();

    $top_items = [];
    $top_items['top_items'] = DB::table('item_list')
      ->select("item_id")
      ->selectRaw('COUNT(*) AS count')
      ->groupBy("item_id")
      ->orderByRaw('COUNT(*) DESC')
      ->limit(3)
      ->get();

    $top_items['all_items_in_list'] = $all_items_in_list;
    foreach ($top_items["top_items"] as $item) {
      $item_data = Item::findOrFail($item->item_id);
      $item->name = $item_data->name;
      $item->percentage = round(($item->count / $top_items['all_items_in_list']) * 100, 0);
    }

    $all_items = Item::all()->count();

    $top_categories = DB::table('item')
      ->select("category_id")
      ->selectRaw('COUNT(*) AS count')
      ->groupBy("category_id")
      ->orderByRaw('COUNT(*) DESC')
      ->limit(3)
      ->get();

    foreach ($top_categories as $category) {
      $category_data = Category::findOrFail($category->category_id);
      $category->name = $category_data->name;
      $category->percentage = round(($category->count / $all_items) * 100, 0);
    }

    $top_items["top_categories"] = $top_categories;
    $top_items["all_items"] = $all_items;

    return view('items.top', ['top_items' => $top_items]);
  }

  public function store(Request $request)
  {
    $item = new Item;
    $item->name = $request->input('name');
    $item->category_id = $request->input('category_id');
    $item->note = $request->input('note');
    $item->image = $request->input('image');
    $item->save();

    return redirect()->route('items.index');
  }

  public function show($id)
  {
    $item = Item::findOrFail($id);
    return response()->json([
      'name' => $item->name,
      'category_id' => $item->category_id,

    ]);
  }


  public function find_by_name(Request $request)
  {
    $item = Item::where('name', '=', $request->input('name'))->first();
    return view('items.show', ['item' => $item]);
  }

  public function edit($id)
  {
    $item = Item::findOrFail($id);
    $categories = Category::all();
    return view('items.edit', ['item' => $item, 'categories' => $categories]);
  }

  public function update(Request $request, $id)
  {
    $item = Item::findOrFail($id);
    $item->name = $request->input('name');
    $item->category_id = $request->input('category_id');
    $item->note = $request->input('note');
    $item->image = $request->input('image');
    $item->save();

    return redirect()->route('items.index');
  }

  public function destroy($id)
  {
    $items_in_list = DB::table('item_list')->where('item_id', '=', $id)->delete();

    $item = Item::findOrFail($id);
    $item->delete();

    return redirect()->route('items.index');
  }
}
