<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Category;
use App\Models\Event;
use App\Models\Reservation;



use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//     public function index()
//     {
//         $AllUsers = User::paginate(5);
//         return view('admin.index', compact('AllUsers'));
//     }


//     public function evento(){
//         $Event = Event::with('organisateur', 'category')->paginate(5);
//         //dd($Event);
//         return view('admin.event', compact('Event'));
//     }
//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         return view('admin.AddCategory');
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(CategoryRequest $request)
//     {
//         $validatedData = $request->validated();
//         $category = new Category([
//             'category_name' => $validatedData['category_name'],
//         ]);
   
//         $category->save();

//         return redirect()->route('admin.create')->with('success', 'Category is added successfully');
//     }

//     public function updateValidation(Request $request, $id)
// {
//     $event = event::find($id);

//     if ($event) {
//         $event->update(['validation' => $event->validation === 'valid' ? 'invalid' : 'valid']);
//         return redirect()->back();
//     }

    
// }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(User $admin)
    // {
    //     //dd($admin);
    //     $admin->delete();
    //     return back()->with('success', 'Operator deleted successfully.');
    // }

    // public function Statistics()
    // {
    //     $userCount = User::count();
    //     $categoryCount = Category::count();
    //     $eventCount = event::count();
    
    //     return view('dashboard', compact('userCount', 'categoryCount', 'eventCount'));
    // }

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

public function statistics ()
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
    return view('admin.dashboard', compact('clientCount','organisateurCount','totalEvents','mostReservedEvent','mostActiveOrganisateur','mostActiveClient'));
}

}
