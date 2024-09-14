<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Complaint\StoreRequest as ComplaintStoreRequest;
use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\Message\MessageResource;
use App\Models\Image;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $ids = str($data['content'])->matchAll('/@[\d]+/')->unique()->transform(function ($id){
            return str($id)->replaceMatches('/@/', '')->value();
        })->filter(function ($id){
            return User::query()->where('id', $id)->exists();
        });

        $imgIds = str($data['content'])->matchAll('/img_id=[\d]+/')->unique()->transform(function ($id){
            return str($id)->replaceMatches('/img_id=/', '')->value();
        });

        $message = Message::query()->create($data);

        Image::query()->where('id', $imgIds)->update([
                'message_id' => $message->id
        ]);

        Image::query()
                ->where('user_id', auth()->id())
                ->whereNull('message_id')
                ->get()
                ->pluck('path')->each(function($path){
                    Storage::disk('public')->delete($path);
                });

        Image::query()
                ->where('user_id', auth()->id())
                ->whereNull('message_id')
                ->delete();

        $message->answeredUsers()->attach($ids);

        return MessageResource::make($message)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function toggleLike(Message $message)
    {
        $message->likedUsers()->toggle(auth()->id());
    }

    public function complaint(Message $message, ComplaintStoreRequest $request)
    {
        $data = $request->validated();
        $message->complainedUsers()->attach(auth()->id(), $data);
    }

}
