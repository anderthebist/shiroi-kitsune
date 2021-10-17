<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coment;
use App\Http\Requests\ComentRequest;

class ComentController extends Controller
{
    public function send(ComentRequest $request) {
        $this->authorize('create', Coment::class);
        $comment = Coment:: create([
            "anime_id"=> $request->anime_id,
            "text"=> $request->text,
            "parent_id"=> $request->parent_id,
            "user_id"=> auth()->user()->id
        ]);
        $user = $comment->user()->first();

        return [
            "id"=> $comment->id,
            "text"=> $comment->text,
            "user"=> $user
        ];
    } 

    public function delete($id) {
        $comment = Coment:: find($id);
        $this->authorize('delete', $comment);
        $comment->delete();
        
        return $comment;
    }
}
