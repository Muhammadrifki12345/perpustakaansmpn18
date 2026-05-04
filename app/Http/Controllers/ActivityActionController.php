<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Comment;
use App\Models\Like;

class ActivityActionController extends Controller
{
    public function toggleLike(Activity $activity)
    {
        $userId = auth()->id();
        $like = Like::where('user_id', $userId)
                    ->where('activity_id', $activity->id)
                    ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id'     => $userId,
                'activity_id' => $activity->id,
            ]);
        }

        return back();
    }

    public function storeComment(Request $request, Activity $activity)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        Comment::create([
            'user_id'     => auth()->id(),
            'activity_id' => $activity->id,
            'content'     => $request->input('content'),
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    /* ─── Activity: Edit ─── */
    public function edit(Activity $activity)
    {
        // Hanya pemilik activity atau admin yang boleh edit
        if (auth()->id() !== $activity->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }
        return back(); // form dihandle secara inline (modal)
    }

    /* ─── Activity: Update ─── */
    public function update(Request $request, Activity $activity)
    {
        if (auth()->id() !== $activity->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'review' => 'nullable|string|max:1000',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $details = $activity->details ?? [];

        if ($request->filled('review')) {
            $details['text'] = $request->input('review');
        }
        if ($request->filled('rating')) {
            $details['rating'] = $request->input('rating');
        }

        $activity->update(['details' => $details]);

        return back()->with('success', 'Aktivitas berhasil diperbarui.');
    }

    /* ─── Activity: Delete ─── */
    public function destroy(Activity $activity)
    {
        if (auth()->id() !== $activity->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $activity->delete();

        return back()->with('success', 'Aktivitas berhasil dihapus.');
    }

    /* ─── Comment: Update ─── */
    public function updateComment(Request $request, Comment $comment)
    {
        if (auth()->id() !== $comment->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment->update(['content' => $request->input('content')]);

        return back()->with('success', 'Komentar berhasil diperbarui.');
    }

    /* ─── Comment: Delete ─── */
    public function destroyComment(Comment $comment)
    {
        if (auth()->id() !== $comment->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
