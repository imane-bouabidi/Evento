<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Categorie;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function adminDash()
    {
        $users = User::all();
        return view('admin.adminDashboard',compact('users'));
    }

    public function updateUsers($user_id)
    {
        $roles = Role::all();
        $userDATA = User::where('id',$user_id)->first();
        return view('updateUsers',compact(['userDATA','roles']));
    }
    public function updateUserDATA(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        if ($request->has('roles')) {
           $role = Role::findOrFail($request->input('roles'));
           $user->roles()->detach();
           $user->assignRole($role);
       }

       return redirect()->route('adminDash')->with('success', 'Rôle utilisateur mis à jour avec succès');
    }




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
        return view('admin.category.listeCategories',compact('categories'));
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
        return view('admin.category.UpdateCategory',compact('categorie'));
    }
    public function addCategory()
    {
        return view('admin.category.addCategory');
    }
    public function Statistiques()
    {
        $categories = Categorie::all()->count();
        $Users = User::all()->count();
        $events = Event::all()->count();
        return view('admin.statistiques.statistiques', compact(['categories','Users','events']));
    }
    public function AddCat(Request $request)
    {
        $request->validate([
            'catName' => 'required|string|max:255',
        ]);
        
        $category = new Categorie([
            'name'=> $request->catName,
        ]);
        
        $category->save();
        return redirect()->route('categories');
    }
    
    
    //categorie
    
    
    public function organisateurDash()
    {
        $events = Event::all();
        return view('organisateur.organisateurDash',compact('events'));
    }
    public function addEventView()
    {
        $categories = Categorie::all();
        return view('organisateur.addEventView',compact('categories'));
    }
    public function AddEvent(Request $request)
    {
            $request->validate([
                'titre' => 'required|string|max:255',
                'description' => 'required|string',
                'date' => 'required|date',
                'places' => 'required|integer',
                'duree' => 'required|string',
                'lieu' => 'required|string',
                'categorie' => 'required|exists:categorie,id',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            $imagePath = $request->file('image')->store('event_images','public');
            $imageName = basename($imagePath);
    
            $event = new Event([
                'user_id'=> Auth::user()->id,
                'titre' => $request['titre'],
                'description' => $request['description'],
                'date' => $request['date'],
                'places' => $request['places'],
                'duree' => $request['duree'],
                'lieu' => $request['lieu'],
                'category_id' => $request['categorie'],
                'image' => $imageName,
            ]);
    
            $event->save();
            return redirect()->route('organisateurDash');
        }
        public function updateEventView($id)
        {
            $categories = Categorie::all();
            $event = Event::findOrFail($id);
            $dateFromDatabase = $event->date; 
            $dateForInput = Carbon::parse($dateFromDatabase)->format('Y-m-d'); // Convertir la date au format HTML5
            return view('organisateur.UpdateEventView',compact(['event','categories','dateForInput']));
        }
}
