<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trek;
use Illuminate\Http\Request;

class AdminTrekController extends Controller
{
    public function index()
    {
        $treks = Trek::all();
        return view('admin.treks.index', compact('treks'));
    }

    public function create()
    {
        return view('admin.treks.create');
    }

    public function store(Request $request)
    {
        Trek::create($request->all());
        return redirect()->route('admin.treks.index')->with('success', 'Trek Added Successfully');
    }

    public function edit($id)
    {
        $trek = Trek::findOrFail($id);
        return view('admin.treks.edit', compact('trek'));
    }

    public function update(Request $request, $id)
    {
        $trek = Trek::findOrFail($id);
        $trek->update($request->all());
        return redirect()->route('admin.treks.index')->with('success', 'Trek Updated Successfully');
    }

    public function destroy($id)
    {
        Trek::destroy($id);
        return redirect()->route('admin.treks.index')->with('success', 'Trek Deleted Successfully');
    }
}
