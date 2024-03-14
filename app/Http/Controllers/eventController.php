<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class eventController extends Controller
{
    public function addEventView()
    {
        $categories = Categorie::all();
        return view('organisateur.addEventView', compact('categories'));
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

        $imagePath = $request->file('image')->store('event_images', 'public');
        $imageName = basename($imagePath);
        $event = new Event([
            'user_id' => Auth::user()->id,
            'titre' => $request['titre'],
            'description' => $request['description'],
            'date' => $request['date'],
            'places' => $request['places'],
            'duree' => $request['duree'],
            'lieu' => $request['lieu'],
            'category_id' => $request['categorie'],
            'image' => $imageName,
            'acceptation' => $request->acceptation,
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
        return view('organisateur.UpdateEventView', compact(['event', 'categories', 'dateForInput']));
    }


    public function UpdateEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $event->titre = $request->input('titre');
        $event->description = $request->input('description');
        $event->date = $request->input('date');
        $event->places = $request->input('places');
        $event->duree = $request->input('duree');
        $event->lieu = $request->input('lieu');
        $event->category_id = $request->input('categorie');

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::delete('public/event_images/' . $event->image);
            }

            $imagePath = $request->file('image')->store('public/event_images');

            $imageName = basename($imagePath);

            $event->image = $imageName;
        }

        $event->save();

        return redirect()->route('organisateurDash');
    }
    public function evenements()
    {
        $evenements = Event::all();
        return view('admin.events.events', compact('evenements'));
    }
    public function valide_event_statut($id)
    {
        $event = Event::findOrFail($id);
        $event->statut = 'valide';
        $event->save();
        return redirect()->route('evenements');
    }
    public function rejeter_event_statut($id)
    {
        $event = Event::findOrFail($id);
        $event->statut = 'rejete';
        $event->save();
        return redirect()->route('evenements');
    }
    public function events()
    {
        $events = Event::all();

        foreach ($events as $event) {
            dd($event->reservations);
        }
    }
}
