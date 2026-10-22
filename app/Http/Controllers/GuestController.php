<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuestRequest;
use App\Models\Guest;
use Illuminate\Support\Facades\Storage;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guests = Guest::all();
        return view('guests.index', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guests.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuestRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('profile-images', 'public');
        } else {
            $filename = uniqid('profile_') . '.jpg';

            Storage::disk('public')->copy(
                'default.jpg',
                'profile-images/' . $filename
            );
            $data['profile_image'] = 'profile-images/' . $filename;
        }

        Guest::create($data);

        return redirect()->route('guests.index')->with('success', 'Record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        return view('guests.form', compact('guest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GuestRequest $request, Guest $guest)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            if ($guest->profile_image && $guest->profile_image !== 'default.jpg') {
                Storage::disk('public')->delete($guest->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('profile-images', 'public');
        }

        $guest->update($data);
        return redirect()->route('guests.index')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        // if ($guest->profile_image) {
        //     Storage::disk('public')->delete($guest->profile_image);
        // }

        $guest->delete();
        return redirect()->route('guests.index')
            ->with('success', 'Record deleted successfully.');
    }

    public function forceDelete($id)
    {
        $guest = Guest::onlyTrashed()->findOrFail($id);

        if (
            $guest->profile_image &&
            $guest->profile_image !== 'default.jpg'
        ) {
            Storage::disk('public')->delete($guest->profile_image);
        }

        $guest->forceDelete();

        return redirect()
            ->route('guests.deleted')
            ->with('success', 'Guest permanently deleted.');
    }

    public function restore($id)
    {
        $guest = Guest::onlyTrashed()->findOrFail($id);
        $guest->restore();

        return redirect()
            ->route('guests.index')
            ->with('success', 'Guest restored successfully.');
    }

    public function deleted()
    {
        $guests = Guest::onlyTrashed()->get();

        return view('guests.deleted', compact('guests'));
    }
}
