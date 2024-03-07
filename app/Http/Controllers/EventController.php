<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // public function viewEvent()
    // {
    //     $user = Auth::user();

    //     $events = Event::with('reservation')
    //         // ->whereNull('archive')
    //         ->where('user_id', $user->id)
    //         ->orderBy('created_at', 'desc')
    //         ->get();
    //     return view('organizer.home', ['event' => $events]);
    // }
    public function viewEvent()
    {
        $events = Event::all();
        return view('organizer.home', ['event' => $events]);
    }
    public function viewAll()
    {
        $user = Auth::id();
        $categories = Category::all();
        $events = Event::all();
        // dd($events);
        return view('admin.allEvents', compact('events'), compact('categories'));
    }


    public function view()
    {
        $user = Auth::id();
        $categories = Category::all();
        $events = Event::where('user_id', $user)
            ->orderby('created_at', 'desc')
            ->get();
        // dd($events);
        return view('organisateur.event', compact('events'), compact('categories'));
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'location' => ['required', 'string', 'max:255'],
                'totalTickets' => 'required',
                'acceptance' =>['required'],
            ]);
            $user = auth()->user();
            Event::create([
                'title' => $request->title,
                'description' => $request->description,
                'date' => now()->toDateString(),
                'location' =>  $request->lieu,
                'totalTickets' => $request->places,
                'acceptance' => $request->acceptance,
                'user_id' => $user->id,
                'category_id' => $request->categoryID,
            ]);
            return redirect()->route('Events');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function updateStatus(Request $request, $eventId)
    {
        $request->validate([
            'statut' => 'required|in:Accepted,Rejected',
        ]);
        $event = Event::findOrFail($eventId);
        $event->statut = $request->statut;
        $event->save();
        return back();
    }
}
