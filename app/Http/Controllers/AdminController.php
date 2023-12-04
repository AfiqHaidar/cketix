<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Concert;
use App\Models\Venue;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.welcomepage');
    }

    // ------------------------- ADMIN PROFILE ------------------------- //
    
        public function edit(Request $request): View{
        return view('admin.edit', [
            'user' => $request->user(),
        ]);
    }
    
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('admin.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    // ------------------------- GUEST ------------------------- //
    
    public function guest()
    {
        $guests = Guest::all();

        return view('admin.guest.guest', ['guests' => $guests]);
    }

    public function addGuest()
    {
        return view('admin.guest.add');
    }

    public function createGuest(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048',
            'pquote' => 'required|string|max:255',
        ]);

        $imagePath = $request->file('image')->store('guests', 'public');
        $validatedData['image'] = $imagePath;

        $guest = Guest::create($validatedData);
        $guest->pquote = $validatedData['pquote'];
        $guest->save();

        return redirect(route('admin.guest'));
    }

    public function editGuest($id)
    {
        $guest = Guest::where('id', $id)->get();
        return view('admin.guest.edit', ['guest' => $guest[0]]);
    }

    public function updateGuest(Guest $guest, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10048',
            'pquote' => 'required|string|max:255',
        ]);

        $guest->name = $validatedData['name'];
        $guest->pquote = $validatedData['pquote'];

        if (isset($validatedData['image'])) {
            $imagePath = $request->file('image')->store('guests', 'public');
            $guest->image = $imagePath;
        }

        $guest->save();
        return redirect()->route('admin.guest');
    }

    public function deleteGuest(Guest $guest)
    {
        $guest->delete();
        return redirect()->route('admin.guest');
    }

    // ------------------------- GUEST END ------------------------- //

    // ------------------------- Concert ------------------------- //
    
    public function concert()
    {
        $concerts = Concert::all();

        return view('admin.concert.concert', ['concerts' => $concerts]);
    }

    public function addConcert()
    {
        return view('admin.concert.add');
    }

    public function createConcert(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048',
            'short_desc' => 'required|string|max:255',
            'long_desc' => 'required|string|max:1000'
        ]);

        $imagePath = $request->file('image')->store('concerts', 'public');
        $validatedData['image'] = $imagePath;

        $concert = Concert::create($validatedData);
        return redirect(route('admin.concert'));
    }

    public function editConcert($id)
    {
        $concert = Concert::where('id', $id)->get();
        return view('admin.concert.edit', ['concert' => $concert[0]]);
    }

    public function updateConcert(Concert $concert, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10048',
            'short_desc' => 'required|string|max:255',
            'long_desc' => 'required|string|max:1000'
            ]);

        $concert->name = $validatedData['name'];
        $concert->short_desc = $validatedData['short_desc'];
        $concert->long_desc = $validatedData['long_desc'];


        if (isset($validatedData['image'])) {
            $imagePath = $request->file('image')->store('concerts', 'public');
            $concert->image = $imagePath;
        }

        $concert->save();
        return redirect()->route('admin.concert');
    }

    public function deleteConcert(Concert $concert)
    {
        $concert->delete();
        return redirect()->route('admin.concert');
    }
    
    // ------------------------- Concert END ------------------------- //

    // ------------------------- Venue ------------------------- //

    public function venue()
    {
        $venues = Venue::all();
        $city_id = City::all();

        return view('admin.venue.venue', ['venues' => $venues, 'city_id' => $city_id]);
    }

    public function addVenue()
    {
        $city_id = City::all();
        return view('admin.venue.add', ['city_id'=>$city_id]);
    }

    public function createVenue(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'city_id' => 'required|integer'
        ]);

        $venue = Venue::create($validatedData);
        return redirect(route('admin.venue'));
    }

    public function editVenue($id)
    {
        $city_id = City::all();
        $venue = Venue::where('id', $id)->get();
        
        return view('admin.venue.edit', ['venue' => $venue[0], 'city_id'=>$city_id]);
    }

    public function updateVenue(Venue $venue, Request $request)
    {
        $city_id = City::all();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'city_id' => 'required|integer'
            ]);

        $venue->name = $validatedData['name'];
        $venue->address = $validatedData['address'];
        $venue->city_id = $validatedData['city_id'];

        $venue->save();
        return redirect()->route('admin.venue');
    }

    public function deleteVenue(Venue $venue)
    {
        $venue->delete();
        return redirect()->route('admin.venue');
    }
    
    // ------------------------- Venue END ------------------------- //
    
    // ------------------------- City ------------------------- //

    public function city()
    {
        $cities = City::all();

        return view('admin.city.city', ['cities' => $cities]);
    }

    public function addCity()
    {
        return view('admin.city.add');
    }

    public function createCity(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $city = City::create($validatedData);
        return redirect(route('admin.city'));
    }

    public function editCity($id)
    {
        $city = City::where('id', $id)->get();
        return view('admin.city.edit', ['city' => $city[0]]);
    }

    public function updateCity(City $city, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            ]);

        $city->name = $validatedData['name'];

        $city->save();
        return redirect()->route('admin.city');
    }

    public function deleteCity(City $city)
    {
        $city->delete();
        return redirect()->route('admin.city');
    }
    
    // ------------------------- City END ------------------------- //
}
