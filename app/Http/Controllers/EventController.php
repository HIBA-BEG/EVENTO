<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function viewAll()
    {
        $user = Auth::id();
        $categories = Category::all();
        $evenements = Event::orderby('created_at', 'desc')
            ->get();
        // dd($events);
        return view('admin.allEvents', compact('events'), compact('categories'));
    }

    public function viewClient()
    {
        $reservation = Reservation::all();
        $evenements = Event::where('statut', "Accepted")
        ->orderby('created_at', 'desc')
        ->get();
        return view('client.event', compact('events'), compact('reservation'));
    }



    public function view()
    {
        $user = Auth::id();
        $categories = Category::all();
        $events = Event::where('user_id', $user)
            ->orderby('created_at', 'desc')
            ->get();
        // dd($events);
        return view('organizer.home', compact('events'), compact('categories'));
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'date' => ['required', 'date'],
                'location' => ['required', 'string', 'max:255'],
                'totalTickets' => 'required',
                'acceptance' => ['required', 'string', 'in:automatic,manual'],
            ]);
            $user = auth()->user();
            Event::create([
                'title' => $request->title,
                'description' => $request->description,
                'date' => $request->input('event_date'),
                'location' =>  $request->location,
                'totalTickets' => $request->totalTickets,
                'acceptance' => $request->acceptance,
                'user_id' => $user->id,
                'categorie_id' => $request->categorieID,
            ]);
            return redirect()->route('Events');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function updateStatus(Request $request, $eventId)
    {
        $request->validate([
            'statuts' => 'required|in:Pending,Approved,Rejected',
        ]);
        $event = Event::findOrFail($eventId);
        $event->statut = $request->statut;
        $event->save();
        return back();
    }

    public function delete(Event $evenement)
    {
        $evenement->delete();
        return redirect()->route('Evenements');
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'titre' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'lieu' => ['required', 'string'],
                'places' => ['required', 'integer'],
                'mode' => ['required', 'in:automatique,manuelle'],
            ]);

            $event = Event::findOrFail($request->event_id);

            $event->update([
                'titre' => $request->titre,
                'description' => $request->description,
                'lieu' => $request->lieu,
                'places' => $request->places,
                'mode' => $request->mode,
                'categorie_id' => $request->categorie,
                'statut' => "Pending",
            ]);

            return redirect()->route('Evenements')->with('success', 'Event updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('Evenements')->with('error', 'Error updating event');
        }
    }

    public function showDetails($id)
    {
        $event = Event::findOrFail($id);

        return view('client.eventDetails', compact('event'));
    }
}
