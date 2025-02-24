<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('user_id', Auth::user()->id)->orderBy('id', 'asc')->get(['id', 'name']);
        $items = Item::with('categories')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        
        return view('dashboard.items-management.items.index', [
            'title' => 'Items'
        ], compact('categories', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cost' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $result = Item::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'cost' => $request->cost,
            'stock' => $request->stock
        ]);

        $result->categories()->attach($request->categories);

        return back()->with('success_add', 'Data has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required',
            'cost' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $item->update([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'cost' => $request->cost,
            'stock' => $request->stock
        ]);

        $item->categories()->sync($request->categories);

        return back()->with('success_edit', 'Data has been edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return back()->with('success_delete', 'Data has been deleted');
    }
}
