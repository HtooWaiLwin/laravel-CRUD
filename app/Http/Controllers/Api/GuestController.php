<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuestRequest;
use App\Http\Resources\GuestResource;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuestController extends Controller
{
    public function index()
    {

        // return GuestResource::collection(
        //     Guest::query()->latest()->get()
        // );
        $guests = Guest::all();
        return response()->json([
            'success' => true,
            'message' => 'Guest lists fetched successfully!',
            'data' => $guests
        ]);
    }

    public function show(Guest $guest)
    {
        return response()->json([
            'success' => true,
            'message' => 'Guest fetched successfully!',
            'data' => $guest,
        ]);
    }

    public function store(GuestRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')
                ->store('profile-images', 'public');
        } else {
            $filename = uniqid('profile_') . '.jpg';
            $path = 'profile-images/' . $filename;

            Storage::disk('public')->copy('default.jpg', $path);

            $data['profile_image'] = $path;
        }

        $guest = Guest::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Guest created successfully!',
            'data' => $guest,
        ], 201);
    }

    public function update(GuestRequest $request, Guest $guest)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            $oldImage = $guest->profile_image;

            $data['profile_image'] = $request->file('profile_image')
                ->store('profile-images', 'public');

            $guest->update($data);

            if ($oldImage && $oldImage !== 'default.jpg') {
                Storage::disk('public')->delete($oldImage);
            }
        } else {
            unset($data['profile_image']);

            $guest->update($data);
        }

        return response()->json([
            'success' => true,
            'message' => 'Guest updated successfully!',
            'data' => $guest,
        ]);
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response()->json([
            'success' => true,
            'message' => 'Guest moved to trash successfully!',
            'data' => [
                'id' => $guest->id,
                'deleted_at' => $guest->deleted_at,
            ],
        ]);
    }

    public function deleted()
    {
        $guests = Guest::onlyTrashed()->get();

        return response()->json([
            'success' => true,
            'message' => 'Deleted guest lists fetched successfully!',
            'data' => $guests,
        ]);
    }

    public function restore(string $id)
    {
        $guest = Guest::onlyTrashed()->findOrFail($id);

        $guest->restore();

        return response()->json([
            'success' => true,
            'message' => 'Guest restored successfully!',
            'data' => $guest->fresh(),
        ]);
    }

    public function forceDelete(string $id)
    {
        $guest = Guest::onlyTrashed()->findOrFail($id);

        if (
            $guest->profile_image &&
            $guest->profile_image !== 'default.jpg'
        ) {
            Storage::disk('public')->delete($guest->profile_image);
        }

        $guest->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Guest permanently deleted!',
            'data' => [
                'id' => $id,
            ],
        ]);
    }
}
