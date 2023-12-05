<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Module\Banner\Presentation\Controller\BannerController;
use App\Models\Guest;
use App\Models\Banner;
use App\Models\Transaction;
use App\Models\Concert;
use App\Models\Venue;
use App\Models\City;
use App\Models\PaymentMethod;
use App\Models\GuestDetail;
use App\Models\ConcertDetail;
use App\Models\Catagory;

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

    public function edit(Request $request): View
    {
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


    public function transaction()
    {
        $transactions = Transaction::all();

        return view('admin.transaction.transaction', ['transactions' => $transactions]);
    }

    public function paymentTr(Transaction $transaction)
    {
        return view('admin.transaction.payment', ['transaction' => $transaction]);
    }

    public function acceptPayment(Transaction $transaction)
    {
        $transaction->status = 'PAID';
        $transaction->save();

        return redirect()->route('admin.transaction');
    }

    public function declinePayment(Transaction $transaction)
    {
        $transaction->status = 'CANCELED';
        $transaction->save();

        return redirect()->route('admin.transaction');
    }


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
        return view('admin.venue.add', ['city_id' => $city_id]);
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

        return view('admin.venue.edit', ['venue' => $venue[0], 'city_id' => $city_id]);
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

    // ------------------------- Payment method ------------------------- //

    public function payment()
    {
        $payments = PaymentMethod::all();

        return view('admin.payment.payment', ['payments' => $payments]);
    }

    public function addPayment()
    {
        return view('admin.payment.add');
    }

    public function createPayment(Request $request)
    {
        $validatedData = $request->validate([
            'payment' => 'required|string|max:255',
        ]);

        $payment = PaymentMethod::create($validatedData);
        $payment->payment = $validatedData['payment'];
        $payment->save();
        return redirect(route('admin.payment'));
    }

    public function editPayment($id)
    {
        $payment = PaymentMethod::where('id', $id)->get();
        return view('admin.payment.edit', ['payment' => $payment[0]]);
    }

    public function updatePayment(PaymentMethod $payment, Request $request)
    {
        $validatedData = $request->validate([
            'payment' => 'required|string|max:255',
        ]);

        $payment->payment = $validatedData['payment'];

        $payment->save();
        return redirect()->route('admin.payment');
    }

    public function deletePayment(PaymentMethod $payment)
    {
        $payment->delete();
        return redirect()->route('admin.payment');
    }

    // ------------------------- Payment method END ------------------------- //


    // ------------------------- GUEST STAR DETAIL ------------------------- //

    public function guest_details()
    {
        $guest_details = GuestDetail::all();
        $concert_id = Concert::all();
        $guest_id = Guest::all();

        return view('admin.guest_details.guest_details', [
            'guest_details' => $guest_details,
            'concert_id' => $concert_id,
            'guest_id' => $guest_id
        ]);
    }

    public function addGuestDetails()
    {
        $concert_id = Concert::all();
        $guest_id = Guest::all();
        return view('admin.guest_details.add', [
            'concert_id' => $concert_id,
            'guest_id' => $guest_id
        ]);
    }

    public function createGuestDetails(Request $request)
    {
        $concert_id = Concert::all();
        $guest_id = Guest::all();
        $validatedData = $request->validate([
            'concert_id' => 'required|integer',
            'guest_id' => 'required|integer',
        ]);

        $guest_details = GuestDetail::create($validatedData);
        return redirect(route('admin.guest_details'));
    }

    public function editGuestDetails($id)
    {
        $concert_id = Concert::all();
        $guest_id = Guest::all();
        $guest_details = GuestDetail::where('id', $id)->get();
        return view('admin.guest_details.edit', [
            'guest_details' => $guest_details[0],
            'concert_id' => $concert_id,
            'guest_id' => $guest_id
        ]);
    }

    public function updateGuestDetails(GuestDetail $guest_details, Request $request)
    {
        $concert_id = Concert::all();
        $guest_id = Guest::all();
        $validatedData = $request->validate([
            'concert_id' => 'required|integer',
            'guest_id' => 'required|integer',
        ]);

        $guest_details->concert_id = $validatedData['concert_id'];
        $guest_details->guest_id = $validatedData['guest_id'];


        $guest_details->save();
        return redirect()->route('admin.guest_details');
    }

    public function deleteGuestDetails(GuestDetail $guest_details)
    {
        $guest_details->delete();
        return redirect()->route('admin.guest_details');
    }

    // ------------------------- GUEST STAR DETAIL END ------------------------- //

    // ------------------------- CONCERT DETAIL ------------------------- //

    public function concert_details()
    {
        $concert_details = ConcertDetail::all();
        $concert_id = Concert::all();
        $venue_id = Venue::all();

        return view('admin.concert_details.concert_details', [
            'concert_details' => $concert_details,
            'concert_id' => $concert_id,
            'venue_id' => $venue_id
        ]);
    }

    public function addConcertDetails()
    {
        $concert_id = Concert::all();
        $venue_id = Venue::all();
        return view('admin.concert_details.add', [
            'concert_id' => $concert_id,
            'venue_id' => $venue_id
        ]);
    }

    public function createConcertDetails(Request $request)
    {
        $concert_id = Concert::all();
        $venue_id = Venue::all();
        $validatedData = $request->validate([
            'date' => 'required|date',
            'concert_id' => 'required|integer',
            'venue_id' => 'required|integer',
            'map' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048'
        ]);

        $mapPath = $request->file('map')->store('maps', 'public');
        $validatedData['map'] = $mapPath;

        $concert_details = ConcertDetail::create($validatedData);
        return redirect(route('admin.concert_details'));
    }

    public function editConcertDetails($id)
    {
        $concert_id = Concert::all();
        $venue_id = Venue::all();
        $concert_details = ConcertDetail::where('id', $id)->get();
        return view('admin.concert_details.edit', [
            'concert_details' => $concert_details[0],
            'concert_id' => $concert_id,
            'venue_id' => $venue_id
        ]);
    }

    public function updateConcertDetails(ConcertDetail $concert_details, Request $request)
    {
        $concert_id = Concert::all();
        $venue_id = Venue::all();
        $validatedData = $request->validate([
            'date' => 'required|date',
            'concert_id' => 'required|integer',
            'venue_id' => 'required|integer',
            'map' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048'
        ]);

        $concert_details->concert_id = $validatedData['concert_id'];
        $concert_details->venue_id = $validatedData['venue_id'];

        $mapPath = $request->file('map')->store('maps', 'public');
        $concert_details->map = $mapPath;

        $concert_details->save();
        return redirect()->route('admin.concert_details');
    }

    public function deleteConcertDetails(ConcertDetail $concert_details)
    {
        $concert_details->delete();
        return redirect()->route('admin.concert_details');
    }

    // ------------------------- CONCERT DETAIL END ------------------------- //

    // ------------------------- CATEGORIES ------------------------- //

    public function categories()
    {
        $categories = Catagory::all();
        // concert details id
        $concert_details = ConcertDetail::all();
        $concert = Concert::all();


        return view('admin.categories.categories', [
            'categories' => $categories,
            'concert_details' => $concert_details,
            'concert' => $concert
        ]);
    }

    public function addCategories()
    {
        $concert_details = ConcertDetail::all();
        return view('admin.concert_details.add', ['concert_details' => $concert_details]);
    }

    public function createCategories(Request $request)
    {
        $concert_details = ConcertDetail::all();

        $validatedData = $request->validate([
            'seat' => 'required|numeric',
            'code' => 'required|string|max:255',
            'price' => 'required|numeric',
            'concert_details' => 'required|integer',
            'venue_id' => 'required|integer',
            'description' => 'required|string|max:1048',
        ]);

        $categories = Catagory::create($validatedData);
        return redirect(route('admin.categories'));
    }

    public function editCategories($id)
    {
        $concert_details = ConcertDetail::all();
        $venue_id = Venue::all();
        $categories = Catagory::where('id', $id)->get();
        return view('admin.concert_details.edit', [
            'categories' => $categories[0],
            'concert_details' => $concert_details,
            'venue_id' => $venue_id
        ]);
    }

    public function updateCategories(Catagory $categories, Request $request)
    {
        // $concert_details = ConcertDetail::all();
        // $venue_id = Venue::all();
        // $validatedData = $request->validate([
        //     'seat' => 'required|numeric',
        //     'code' => 'required|string|max:255',
        //     'price' => 'required|numeric',
        //     'concert_details' => 'required|integer',
        //     'venue_id' => 'required|integer',
        //     'description' => 'required|string|max:1048',
        // ]);

        // $concert_details->concert_details = $validatedData['concert_details'];
        // $concert_details->venue_id = $validatedData['venue_id'];

        // $categories->save();
        // return redirect()->route('admin.categories');
    }

    public function deleteCategories(Catagory $categories)
    {
        $categories->delete();
        return redirect()->route('admin.categories');
    }


    private BannerController $bannerController;

    public function __construct(BannerController $bc)
    {
        $this->bannerController = $bc;
    }

    public function banner()
    {
        $banners = $this->bannerController->getAllBanners();

        return view('admin.banner.banner', ['banners' => $banners]);
    }

    public function addBanner()
    {
        return view('admin.banner.add');
    }

    public function editBanner($id)
    {
        $banner = Banner::where('id', $id)->get();
        return view('admin.banner.edit', ['banner' => $banner[0]]);
    }
}
