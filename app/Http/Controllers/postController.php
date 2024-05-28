<?php

namespace App\Http\Controllers;



use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function addPost(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'type' => 'required|string',
            'title' => 'required|string',
            'recordScore' => 'required|string',
            'recorder' => 'required|string',
            'date' => 'required|date',
            'proveFile' => 'required|url',
            'cover' => 'nullable|image|mimes:png,jpg|max:2048',
            'awardSpeech' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $post = new Post();
        $post->title = $request->title;
        $post->date = $request->date;
        $post->recorder = $request->recorder;
        $post->awardSpeech = $request->awardSpeech;
        $post->type = $request->type;
        $post->recordScore = $request->recordScore;
        $post->proveFile = $request->proveFile;
        $post->user_id = $request->user_id;
        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/images/recordImg'), $imageName);
            $post->cover = '/images/recordImg/' . $imageName;
        }

        $post->save();

        return response()->json([
            'message' => 'Post has been sent for approval',
            'code' => 200,
            'post' => $post
        ]);
    }

    public function showall(Request $request)
    {
        $query = Post::where('ifProved', 'approved');

        $type = $request->query('type');
        if ($type) {
            $query->where('type', $type);
        }

        $posts = $query->get();
        return response()->json($posts);
    }

    public function verifyPosts(Request $request)
    {
        $status = $request->query('status');
        if ($status) {
            $posts = Post::where('ifProved', $status)->get();
        } else {
            $posts = Post::all();
        }
        return response()->json($posts);
    }

    public function index(Request $request)
    {
        $posts = Post::where('ifProved', 'approved')->get();

        return response()->json($posts);
    }


    public function approve(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->ifProved = 'approved';
        $post->save();

        return response()->json(['message' => 'Post approved successfully']);
    }

    public function reject(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->ifProved = 'rejected';
        $post->save();

        return response()->json(['message' => 'Post rejected successfully']);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    public function getSimilarTitles(Request $request)
    {
        $title = $request->query('title');
        if (!$title) {
            return response()->json([]);
        }

        $similarTitles = Post::where('title', 'LIKE', '%' . $title . '%')->pluck('title');
        return response()->json($similarTitles);
    }
}
