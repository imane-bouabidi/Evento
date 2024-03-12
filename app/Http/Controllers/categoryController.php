<?php

namespace App\Http\Controllers;
use App\Models\Categorie;

use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function updateCategoryDATA(Request $request, $id)
    {
        $categorie = Categorie::findOrFail($id);


        $categorie->name = $request->catName;
        $categorie->save();

        return redirect()->route('categories')->with('success', 'Rôle utilisateur mis à jour avec succès');
    }
    public function categories()
    {
        $categories = Categorie::all();
        return view('admin.category.listeCategories', compact('categories'));
    }
    public function deleteCat($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
        return redirect()->route('categories');
    }
    public function updateCategory($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('admin.category.UpdateCategory', compact('categorie'));
    }
    public function addCategory()
    {
        return view('admin.category.addCategory');
    }
    public function AddCat(Request $request)
    {
        $request->validate([
            'catName' => 'required|string|max:255',
        ]);

        $category = new Categorie([
            'name' => $request->catName,
        ]);

        $category->save();
        return redirect()->route('categories');
    }
}
