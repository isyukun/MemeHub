<?php

namespace App\Http\Controllers;

use App\Models\Meme;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreMemeRequest;

class MemeController extends Controller
{
    public function index(Request $request) 
    {
        // Cukup panggil scope filter dengan array request
        $memes = Meme::with(['user', 'likes', 'comments'])
            ->latest()
            ->filter($request->only(['search', 'category']))
            ->get();

        // Trending memes tetap aman
        $trendingMemes = Meme::withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(3)
            ->get();

        $categories = ['Umum', 'Menulis', 'Musik', 'Coding', 'Olahraga'];
        
        return view('dashboard', compact('memes', 'categories', 'trendingMemes'));
    }

    public function store(StoreMemeRequest $request) 
    {
        // 1. Validasi sudah ditangani oleh StoreMemeRequest (Pilar 1)
        $validated = $request->validated();
        
        // 2. Persiapan File
        $image = $request->file('image');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $directory = storage_path('app/public/memes');

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // 3. Proses Watermark & Simpan
        $this->processImageWithWatermark($image, $directory . '/' . $name);

        // 4. Input ke Database
        Meme::create([
            'user_id'      => auth()->id(),
            'title'        => $validated['title'],
            'category'     => $validated['category'],
            'is_exclusive' => $request->has('is_exclusive'),
            'image_path'   => 'memes/' . $name,
        ]);

        return back()->with('success', 'Meme berhasil di-upload!');
    }

    /**
     * Helper untuk memisahkan logic pengolahan gambar (Pilar 1)
     */
    private function processImageWithWatermark($file, $savePath) 
    {
        $ext = strtolower($file->getClientOriginalExtension());
        $img = match($ext) {
            'jpg', 'jpeg' => imagecreatefromjpeg($file->getRealPath()),
            'png'         => imagecreatefrompng($file->getRealPath()),
            'gif'         => imagecreatefromgif($file->getRealPath()),
            default       => null,
        };

        if ($img) {
            $white = imagecolorallocate($img, 255, 255, 255);
            $text  = "Mem'Me - @" . auth()->user()->name;
            $x     = imagesx($img) - 160;
            $y     = imagesy($img) - 25;
            
            imagestring($img, 5, $x, $y, $text, $white);

            if ($ext == 'png') imagepng($img, $savePath);
            elseif ($ext == 'gif') imagegif($img, $savePath);
            else imagejpeg($img, $savePath);

            imagedestroy($img);
        }
    }

    public function toggleLike(Meme $meme) {
        $existingLike = Like::where('user_id', auth()->id())
                            ->where('meme_id', $meme->id)
                            ->first();

        if ($existingLike) {
            $existingLike->delete(); // Hapus like jika sudah ada
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'meme_id' => $meme->id
            ]);
        }

        if (!$existingLike) {
            // Kirim notif ke pemilik meme
            if ($meme->user_id !== auth()->id()) {
                \App\Models\Notification::create([
                    'user_id' => $meme->user_id,
                    'message' => auth()->user()->name . " menyukai meme Anda: " . $meme->title,
                ]);
            }
        }

        return back();
    }

    public function storeComment(Request $request, Meme $meme) {
        $request->validate(['body' => 'required|string|max:500']);

        Comment::create([
            'user_id' => auth()->id(),
            'meme_id' => $meme->id,
            'body' => $request->body,
        ]);

        if ($meme->user_id !== auth()->id()) {
            \App\Models\Notification::create([
                'user_id' => $meme->user_id,
                'message' => auth()->user()->name . " mengomentari meme Anda.",
            ]);
        }

        return back()->with('success', 'Komentar terkirim!');
    }

    public function destroy(Meme $meme)
    {
        // Menggunakan Policy secara otomatis mengecek user_id
        $this->authorize('delete', $meme); 

        Storage::disk('public')->delete($meme->image_path);
        $meme->delete();

        return back()->with('success', 'Meme berhasil dihapus!');
    }

    public function destroyComment(Comment $comment)
    {
        // Cek apakah user pemilik komentar
        $this->authorize('delete', $comment); 

        $comment->delete();
        return back()->with('success', 'Komentar dihapus!');
    }
}