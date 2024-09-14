<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    public function personal()
    {
        $user = UserResource::make(auth()->user())->resolve();
        return inertia('User/personal', compact('user'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
                'avatar' => 'required|file'
        ]);

        if(auth()->user()->avatar) {
            Storage::disk('public')->delete(auth()->user()->avatar);
        }

        $path = Storage::disk('public')->put('/avatars', $data['avatar']);

        auth()->user()->update([
                'avatar' => $path
        ]);

        return UserResource::make(auth()->user())->resolve();
    }
}
