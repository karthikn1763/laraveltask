<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormItem;
use App\Models\FormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    public function create()
    {
        return view('form.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'file' => 'nullable|file|max:2048',
            'items' => 'required|array',
            'items.*.name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
        }

        $form = Form::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'file_path' => $filePath,
        ]);

        foreach ($request->items as $item) {
            FormItem::create([
                'form_id' => $form->id,
                'item_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return redirect('/dashboard')->with('success', 'Form submitted successfully.');
    }

    public function edit($id)
    {
        $form = Form::with('items')->findOrFail($id); 
        return view('form.edit', compact('form'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'file' => 'nullable|file|max:2048',
            'items' => 'required|array',
            'items.*.name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $form = Form::findOrFail($id);
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
            $form->file_path = $filePath;
        }

        $form->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        FormItem::where('form_id', $id)->delete();
        foreach ($request->items as $item) {
            FormItem::create([
                'form_id' => $form->id,
                'item_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return redirect('/dashboard')->with('success', 'Form updated successfully.');
    }

    public function destroy($id)
    {
        $form = Form::findOrFail($id);
        $form->delete();

        return redirect('/dashboard')->with('success', 'Form deleted successfully.');
    }

    public function index()
    {
        $forms = Form::where('user_id', Auth::id())->with('items')->get();
        return view('form.index', compact('forms'));
    }
}
