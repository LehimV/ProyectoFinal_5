<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lista;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;

class ListaController extends Controller
{
  public function index()
  {
    $lists = Lista::all();
    return view('lists.index', ['lists' => $lists]);
  }

  public function create()
  {
    return view('lists.create');
  }

  public function store(Request $request)
  {
    $list = new Lista;
    $list->name = $request->input('name');
    $list->active = $request->input('active');
    $list->user_id = $request->input('user_id');
    $list->save();

    return redirect()->route('lists.index');
  }

  public function show($id)
  {
    $list = Lista::findOrFail($id);
    return view('lists.show', ['list' => $list]);
  }

  public function find_by_name(Request $request)
  {
    $list = Lista::where('name', '=', $request->input('name'))->first();
    return view('lists.show', ['list' => $list]);
  }

  public function find_by_user_id(Request $request)
  {
    $list = Lista::where('user_id', '=', $request->input('user_id'))->where('active', '=', 1)->first();
    $categories = (new CategoryController)->get_items();
    $list_items = [];

    foreach ($list->items as $item) {
      $categories = collect($categories);
      $category = $categories->where('id', $item->category_id)->first();

      $item->category_name = $category->name;
      $list_items[] = $item;
    }

    return view('lists.show', ['list' => $list, 'categories' => $categories, 'list_items' => $list_items]);
  }

  public function find_items_grouped_by_category(Request $request)
  {
    $list = Lista::where('id', '=', $request->input('list_id'))->first();
    $categories = (new CategoryController)->get_items();
    $list_items = [];

    foreach ($list->items as $item) {
      $categories = collect($categories);
      $category = $categories->where('id', $item->category_id)->first();

      $item->category_name = $category->name;
      $list_items[] = $item;
    }

    return view('lists.show', ['list' => $list, 'categories' => $categories, 'list_items' => $list_items]);
  }

  public function find_items($id)
  {
    $list = Lista::findOrFail($id);
    $items = $list->items;
    return view('lists.items', ['list' => $list, 'items' => $items]);
  }

  public function find_lists_by_month_year(Request $request)
  {
    $months = DB::table("list")
      ->selectRaw("to_char(created_at , 'YYYY-MM') AS new_date")
      ->where("active", "=", "0")
      ->where("user_id", "=", $request->input('user_id'))
      ->orderBy('created_at', "DESC")
      ->groupBy('created_at')
      ->get();

    $lists_by_month = [];
    foreach ($months as $month) {
      $month_year = $month->new_date;
      $lists = DB::table("list")
        ->selectRaw("id,name,canceled,to_char(created_at , 'YYYY-MM') AS new_date,to_char(created_at , 'DD.MM.YYYY') AS created_at, to_char(created_at,'Day') AS day,to_char(created_at,'Month') AS month,to_char(created_at , 'YYYY') AS year")
        ->where("active", "=", "0")
        ->where("user_id", "=", $request->input('user_id'))
        ->where(DB::raw("to_char(created_at , 'YYYY-MM')"), "=", $month_year)
        ->orderBy('created_at', "DESC")
        ->get();

      $count = 0;
      foreach ($lists as $list) {
        $items = DB::table("item_list")
          ->selectRaw('COUNT(*) AS count')
          ->where("lista_id", "=", $list->id)
          ->get();
        $count = $count + $items[0]->count;
      }
      $month_items = [];
      $month_items["name"] = $lists[0]->month;
      $month_items["count"] = $count;
      $lists_by_month[] = $month_items;
    }

    return view('lists.months', ['lists_by_month' => $lists_by_month]);
  }

  public function get_number_items_by_month()
  {
    $months = DB::table("list")
      ->selectRaw("to_char(created_at , 'YYYY-MM') AS new_date")
      ->where("active", "=", "0")
      ->orderBy('created_at', "DESC")
      ->groupBy('created_at')
      ->get();

    $lists_by_month = [];
    foreach ($months as $month) {
      $month_year = $month->new_date;
      $lists = DB::table("list")
        ->selectRaw("id,name,canceled,to_char(created_at , 'YYYY-MM') AS new_date,to_char(created_at , 'DD.MM.YYYY') AS created_at, to_char(created_at,'Day') AS day,to_char(created_at,'Month') AS month,to_char(created_at , 'YYYY') AS year")
        ->where("active", "=", "0")
        ->where(DB::raw("to_char(created_at , 'YYYY-MM')"), "=", $month_year)
        ->orderBy('created_at', "DESC")
        ->get();

      $count = 0;
      foreach ($lists as $list) {
        $items = DB::table("item_list")
          ->selectRaw('COUNT(*) AS count')
          ->where("lista_id", "=", $list->id)
          ->get();
        $count = $count + $items[0]->count;
      }
      $month_items = [];
      $month_items["name"] = $lists[0]->month;
      $month_items["count"] = $count;
      $lists_by_month[] = $month_items;
    }

    return view('lists.month_items', ['lists_by_month' => $lists_by_month]);
  }

  public function add_item_to_list($item_id, $list_id)
  {
    $item = Item::findOrFail($item_id);
    $list = Lista::findOrFail($list_id);
    if (!$item->lists->contains($list_id)) {
      $item->lists()->attach($list);
      return $item;
    }

    return 400;
  }

  public function set_active_list($list_id)
  {
    $lists = Lista::all();
    foreach ($lists as $list) {
      if ($list->id != $list_id && $list->active) {
        $list->active = false;
      } else if ($list->id == $list_id && !$list->active) {
        $list->active = true;
      }
      $list->save();
    }

    return 200;
  }

  public function cancel_complete_list(Request $request)
  {
    $list = Lista::findOrFail($request->input('list_id'));
    $list->canceled = $request->input('canceled');
    $list->active = false;
    $list->save();

    return 200;
  }

  public function edit($id)
  {
    //
  }

  public function update(Request $request)
  {
    $list = Lista::findOrFail($request->input('id'));
    $list->name = $request->input('name');
    $list->active = $request->input('active');
    $list->user_id = $request->input('user_id');

    $list->save();

    return $list;
  }

  public function update_list_items(Request $request)
  {
    $list = Lista::findOrFail($request->input('list_id'));
    $items = json_decode($request->input('items'), true);

    foreach ($items as $item) {
      $this->add_item_to_list($item['id'], $list->id);

      $item_in_list = DB::table('item_list')
        ->where('item_id', '=', $item['id'])
        ->where('lista_id', '=', $request->input('list_id'))
        ->update(['quantity' => $item['pivot']['quantity']]);
    }

    return redirect()->route('lists.items', ['id' => $list->id]);
  }

  public function update_item_quantity(Request $request)
  {
    $item_in_list = DB::table('item_list')
      ->where('item_id', '=', $request->input('item_id'))
      ->where('lista_id', '=', $request->input('list_id'))
      ->update(['quantity' => $request->input('quantity')]);

    return $item_in_list;
  }

  public function remove_item_from_list(Request $request)
  {
    $item_in_list = DB::table('item_list')
      ->where('item_id', '=', $request->input('item_id'))
      ->where('lista_id', '=', $request->input('list_id'))
      ->delete();

    return redirect()->route('lists.items', ['id' => $request->input('list_id')]);
  }

  public function destroy($id)
  {
    $list = Lista::findOrFail($id);
    $list->delete();

    return redirect()->route('lists.index');
  }
}
