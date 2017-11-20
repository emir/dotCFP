<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Talk;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\RedirectResponse;

class CommentsController extends Controller
{
    /**
     * @param CommentRequest $request
     * @param Talk $talk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentRequest $request, Talk $talk): RedirectResponse
    {
        $talk->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->get('comment')
        ]);

        flash()->success('You have successfully added your comment!');

        return response()->redirectToRoute('talks.show', $talk->id);
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();

        flash()->success('You have successfully deleted your comment!');

        return response()->redirectToRoute('talks.show', $comment->talk_id);
    }
}
