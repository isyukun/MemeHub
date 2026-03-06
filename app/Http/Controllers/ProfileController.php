<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Meme;
use App\Models\Like; // Tambahkan ini
use App\Models\Notification; // Tambahkan ini

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $memes = Meme::where('user_id', $user->id)->withCount('likes')->latest()->get();
        
        return view('profile.show', [
            'user' => $user,
            'memes' => $memes
        ]);
    }

    public function edit(Request $request): View
    {
        $user = $request->user();
        // Pakai Meme:: langsung karena sudah di-import di atas
        $memes = Meme::where('user_id', $user->id)->withCount('likes', 'comments')->latest()->get();
        
        // Pakai Like:: langsung
        $totalLikesReceived = Like::whereIn('meme_id', $memes->pluck('id'))->count();

        return view('profile.edit', [
            'user' => $user,
            'memes' => $memes,
            'totalLikesReceived' => $totalLikesReceived,
        ]);
    }

    // ... (fungsi update dan destroy tetap sama) ...

    public function toggleFollow(User $user) {
        $me = auth()->user();
        if ($me->id === $user->id) return back();

        if ($me->isFollowing($user)) {
            $me->followings()->detach($user->id);
        } else {
            $me->followings()->attach($user->id);
            
            // Pakai Notification:: langsung
            Notification::create([
                'user_id' => $user->id,
                'message' => $me->name . " mulai mengikuti Anda! ✨",
            ]);
        }
        return back();
    }
}