<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Event;
use App\Models\Reservation;



use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function viewUsers()
    {
        $users = User::where('role', '<>', 'Admin')->get();
        return view('admin.users', compact('users'));
    }

    public function banUser($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->update(['banned' => true]);
            if (auth()->check() && auth()->user()->id == $userId) {
                auth()->logout();
                return redirect()->route('login')->with('banned_message', 'You are banned from logging in.');
            }

            return redirect()->route('users')->with('success', 'User has been banned.');
        }

        return redirect()->route('users')->with('error', 'User not found.');
    }

    public function unbanUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->update(['banned' => false]);
            return redirect()->route('users')->with('success', 'User unbanned successfully.');
        }
        return redirect()->route('users')->with('error', 'User not found.');
    }

    public function statistics()
    {
        $clientCount = User::where('role', 'Client')->count();
        $organisateurCount = User::where('role', 'Organizer')->count();
        $totalEvents = Event::count();
        $mostReservedEvent = Event::select('title')
            ->withCount('reservations')
            ->orderBy('reservations_count', 'desc')
            ->value('title');
        $mostActiveOrganisateur = User::select('name')
            ->where('role', 'Organizer')
            ->withCount('events')
            ->orderBy('events_count', 'desc')
            ->value('name');

        $mostActiveClient = User::select('name')
            ->where('role', 'Client')
            ->withCount('reservations')
            ->orderBy('reservations_count', 'desc')
            ->value('name');
        $eventWithMostReservations = Event::select('title')
            ->withCount('reservations')
            ->orderBy('reservations_count', 'desc')
            ->value('title');
        $mostUsedCategory = Category::select('title')
            ->withCount('events')
            ->orderBy('events_count', 'desc')
            ->value('title');
        return view('admin.dashboard', compact('clientCount', 'organisateurCount', 'totalEvents', 'mostReservedEvent', 'mostActiveOrganisateur', 'mostActiveClient'));
    }
}
