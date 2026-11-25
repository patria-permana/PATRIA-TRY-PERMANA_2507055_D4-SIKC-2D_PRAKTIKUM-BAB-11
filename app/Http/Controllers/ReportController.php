<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::With(['user', 'category'])
        ->latest()
        ->paginate(10); 
    return view('reports.index', compact('reports'));
    }

     public function create(){
        $categories = Category::all();

        return view('reports.create', compact('categories'));
    }

    public function show(string $id)
    {
        $report = Report::with(['user', 'category'])->findOrFail($id);

        return view('reports.show', compact('report'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $path = null;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('reports', 'public');
        }

        Report::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'] ?? null,
            'category_id' => $validated['category_id'],
            'user_id' => Auth::id(),
            'status' => 'pending',
            'photo' => $path,
        ]);

        return redirect()->route('reports.index')
            ->with('success', 'Laporan berhasil dibuat');
    }

    public function edit(string $id)
    {
        $report = Report::findOrFail($id);
        $categories = Category::all();

        return view('reports.edit', compact('report', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $report = Report::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            if ($report->photo) {
                Storage::disk('public')->delete($report->photo);
            }

            $validated['photo'] = $request->file('photo')->store('reports', 'public');
        }

        $report->update($validated);

        return redirect()->route('reports.index')
            ->with('success', 'Laporan berhasil diperbarui');
    }

    public function destroy(string $data){
        

        $report = Report::findorFail($data);
        $report->delete();

        if($report->photo){
            Storage::disk('public')->delete($report->photo);
        }

        return redirect()
        ->route('reports.index')
        ->with('success', 'Laporan berhasil dihapus');


    }

    
}
