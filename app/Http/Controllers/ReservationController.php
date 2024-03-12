<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function createReservation($eventId)
    {
        $event = Event::findOrFail($eventId);
        if ($event->acceptance === 'automatic' && $event->totalTickets > 0) {
            Reservation::create([
                'title' => $event->title,
                'date' => now(),
                'status' => 'Approved',
                'numplace' => $this->getNextPlaceNumber($event),
                'event_id' => $event->id,
                'user_id' => auth()->id(),
            ]);
            $event->decrement('totalTickets');
        } else {
            if ($event->acceptance === 'manual' && $event->totalTickets > 0) {
                Reservation::create([
                    'title' => $event->title,
                    'date' => now(),
                    'status' => 'Pending',
                    'numplace' => $this->getNextPlaceNumber($event),
                    'event_id' => $event->id,
                    'user_id' => auth()->id(),
                ]);
            }
        }
        return redirect()->route('client.home');
    }

    private function getNextPlaceNumber($event)
    {
        $highestReservedPlace = Reservation::where('event_id', $event->id)
            ->where('status', 'Approved')
            ->max('numplace');
        return $highestReservedPlace + 1;
    }

    public function viewReservations($eventId)
    {
        $eventReservations = Reservation::where('event_id', $eventId)->get();
        return view('organizer.reservations', ['reservations' => $eventReservations]);
    }

    public function updateReservationStatus(Request $request, $reservationId){
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
        ]);
        $reservation = Reservation::findOrFail($reservationId);
        // dd($reservation);
        $reservation->status = $request->status;
        // $reservation->totalTickets = $this->getNextPlaceNumber($reservation->event);
        // $reservation->event->decrement('totalTickets');

        $reservation->save();
        if ($request->status === 'Approved') {
            $reservation->event->decrement('totalTickets');
        }
        return back();
    }


    public function generateTicket(Reservation $reservation, Event $event)
    {
        return view('client.ticket', compact('reservation', 'event'));
    }
}
