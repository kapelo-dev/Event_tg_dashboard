<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('events')->get();
        $total_events = $categories->sum('events_count');
        return view('categories.index', compact('categories', 'total_events'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'active' => 'nullable'
        ]);

        $validated['active'] = $request->has('active') ? 1 : 0;
        $validated['slug'] = Str::slug($validated['name']);

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'active' => 'nullable'
        ]);

        $newActiveState = $request->has('active') ? 1 : 0;
        
        // Si on essaie de désactiver la catégorie, vérifier si elle a des événements
        if ($category->active && !$newActiveState) {
            $hasActiveEvents = $category->events()
                ->where(function($query) {
                    $query->where('end_date', '>=', now())
                        ->orWhereNull('end_date');
                })
                ->exists();

            if ($hasActiveEvents) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['active' => 'Impossible de désactiver cette catégorie car elle contient des événements actifs.']);
            }
        }

        $validated['active'] = $newActiveState;
        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(Category $category)
    {
        if($category->events()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Impossible de supprimer une catégorie contenant des événements.');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
} 