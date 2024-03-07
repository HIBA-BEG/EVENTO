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
        $evenements = Event::where('status', "Approved")
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
                'totalTickets' => ['required', 'integer'],
                'acceptance' => ['required', 'string', 'in:automatic,manual'],
                'categoryID' => ['required', 'exists:categories,id'],
            ]);
            $user = auth()->user();
            Event::create([
                'title' => $request->title,
                'description' => $request->description,
                'date' => $request->input('date'),
                'location' =>  $request->location,
                'totalTickets' => $request->totalTickets,
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
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);
        $event = Event::findOrFail($eventId);
        $event->status = $request->status;
        $event->save();
        return back();
    }

    public function delete(Event $event)
    {
        $event->delete();
        return redirect()->route('Events');
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'date' => ['required', 'date'],
                'location' => ['required', 'string', 'max:255'],
                'totalTickets' => ['required', 'integer'],
                'acceptance' => ['required', 'string', 'in:automatic,manual'],
            ]);

            $event = Event::findOrFail($request->event_id);

            $event->update([
                'title' => $request->title,
                'description' => $request->description,
                'date' => $request->input('date'),
                'location' =>  $request->location,
                'totalTickets' => $request->totalTickets,
                'acceptance' => $request->acceptance,
                'category_id' => $request->category,
                'status' => "Pending",
            ]);

            return redirect()->route('Events')->with('success', 'Event updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('Events')->with('error', 'Error updating event');
        }
    }

    public function showDetails($id)
    {
        $event = Event::findOrFail($id);

        return view('client.moreDetails', compact('event'));
    }
}
