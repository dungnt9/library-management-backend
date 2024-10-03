<?php

namespace App\Http\Controllers;

use App\Models\Reader;
use Illuminate\Http\Request;

class ReaderController extends Controller
{
    public function index()
    {
        return Reader::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:readers',
        ]);

        return Reader::create($request->all());
    }

    public function show(Reader $reader)
    {
        return $reader;
    }

    public function update(Request $request, Reader $reader)
    {
        $reader->update($request->all());
        return $reader;
    }

    public function destroy(Reader $reader)
    {
        $reader->delete();
        return response()->json(null, 204);
    }
}