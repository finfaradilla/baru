<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class DashboardItemController extends Controller
{
    public function index()
    {
        return view('dashboard.items.index', [
            'items' => Item::all(),
            'title' => 'Manage Items'
        ]);
    }

    public function create()
    {
        return view('dashboard.items.create', ['title' => 'Add Item']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'available' => 'required|boolean',
        ]);

        Item::create($validatedData);

        return redirect('/dashboard/items')->with('itemSuccess', 'Item added successfully.');
    }

    public function edit(Item $item)
    {
        return view('dashboard.items.edit', [
            'item' => $item,
            'title' => 'Edit Item'
        ]);
    }

    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'available' => 'required|boolean',
        ]);

        $item->update($validatedData);

        return redirect('/dashboard/items')->with('itemSuccess', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect('/dashboard/items')->with('deleteItem', 'Item deleted successfully.');
    }
}
