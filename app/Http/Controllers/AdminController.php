<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.welcomepage');
    }

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

    public function concert()
    {
        return view('admin.concert');
    }
}
