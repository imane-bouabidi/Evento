<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Carbon\Carbon;
use App\Models\Categorie;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;


use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class HomeController extends Controller
{
    public function adminDash()
    {
        $users = User::all();
        return view('admin.adminDashboard', compact('users'));
    }

    public function updateUsers($user_id)
    {
        $roles = Role::all();
        $userDATA = User::where('id', $user_id)->first();
        return view('admin.updateUsers', compact(['userDATA', 'roles']));
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

    public function Statistiques()
    {
        $categories = Categorie::all()->count();
        $Users = User::all()->count();
        $events = Event::all()->count();
        return view('admin.statistiques.statistiques', compact(['categories', 'Users', 'events']));
    }


    //categorie


    public function organisateurDash()
    {
        $events = Event::all();
        return view('organisateur.organisateurDash', compact('events'));
    }
   
    public function Index()
    {
        $categories = Categorie::all();
        $events = Event::where('statut', 'valide')->paginate(6);
        return view('index', compact(['events','categories']));
    }
    public function details($id)
    {
        $event = Event::find($id);
        $reste = $event->places - $event->reservations->where('isValide', 'validee')->count();
        return view('details', compact(['event', 'reste']));
    }

    public function search(Request $request)
    {
        $titre = $request->input('titre');
        $events = Event::where('titre', 'LIKE', "%$titre%")->where('statut', 'valide')->paginate(3);
        return view('index', compact('events'));
    }

    public function reserver($id)
    {
        $event = Event::find($id);
        if ($event->acceptation == "automatique") {
            $isValide = "validee";
        } else {
            $isValide = "en attente";
        }

        $ticketCode = uniqid();
        $reservation = new Reservation([
            'user_id' => Auth::user()->id,
            'event_id' => $id,
            'isValide' => $isValide,
            'ticket_code' => $ticketCode,
        ]);

        $reservation->save();
        return redirect()->route('userDash');
    }
    public function userDash()
    {
        $reservations = Reservation::where('user_id', Auth::user()->id)->get();
        return view('user.userDash', compact('reservations'));
    }

    public function generate($id)
    {
        $reservation = Reservation::findOrFail($id);

        // $qrCode = QrCode::generate($reservation->ticket_code);

        $pdf = PDF::loadView('user.ticket', compact('reservation'));

        return $pdf->download('ticket.pdf');
    }

    public function filtrer($catId)
    {
        $categories = Categorie::all();
        $events = Event::where('category_id', $catId)->paginate(6);
        return view('index', compact(['events','categories']));
    }
    public function reservations()
    {
        $reservations = Reservation::whereHas('event', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();
        return view('organisateur.liste_reservations', compact('reservations'));
    }
    public function valider_reservation($id)
    {
        $reservation = Reservation::find($id);
        $reservation->isValide = 'validee';
        $reservation->save();
        return redirect()->route('reservations');
    }
    public function bannerUser($id)
    {
        $user = User::find($id);
        $user->isActive = 0;
        $user->save();
        return redirect()->route('adminDash');
    }


}
