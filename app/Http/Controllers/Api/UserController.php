<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager; // ⬅️ uus klass
use Tinify\Tinify;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;


class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::paginate(6));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Loo kasutaja
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('secret'),
        ]);

        // FOTO töötlus
        $photo = $request->file('photo');
        $filename = 'user_' . $user->id . '.jpg';

        // Loo ImageManager
        $manager = new ImageManager(new GdDriver());

        // Kärbi keskele ja kodeeri jpg'na (70x70)
        $image = $manager
            ->read($photo)
            ->cover(70, 70)
            ->toJpeg(90); // tagastab BinaryImage objekti

        // Salvesta pilt
        Storage::disk('public')->put('photos/' . $filename, (string) $image);

        // OPTIMEERI TinyPNG abil
        \Tinify\setKey(config('services.tinify.key'));
        $source = \Tinify\fromFile(public_path("storage/photos/$filename"));
        $source->toFile(public_path("storage/photos/$filename"));

        // Lisa pilditee andmebaasi
        $user->update([
            'photo' => "storage/photos/$filename"
        ]);

        return response()->json($user, 201);
    }
}
