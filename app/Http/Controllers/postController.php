<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class postController extends Controller
{
    public function addPost(Request $request){
        $incomingFields = $request->validate([
            'title' => 'required',
            'date' => 'required',
            'recorder' => 'required',
            'awardSpeech' => 'nullable',
            'type' => 'required',
            'recordScore' => 'required',
            'proveFile' => 'required|url',
            'cover' => 'required|file|mimes:jpg,png',

        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['recorder'] = strip_tags($incomingFields['recorder']);
        $incomingFields['awardSpeech'] = strip_tags($incomingFields['awardSpeech']);
        $incomingFields['recordScore'] = strip_tags($incomingFields['recordScore']);
        $incomingFields['proveFile'] = strip_tags($incomingFields['proveFile']);

        if($request->hasFile('cover')){
            $incomingFields['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Post::create($incomingFields);

        return redirect('/');
        
    }
}
