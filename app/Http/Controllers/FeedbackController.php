<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        return response()->json($feedbacks);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'feedback_comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $feedback = Feedback::create($request->all());
        return response()->json($feedback, 201);
    }

    public function show($id)
    {
        $feedback = Feedback::findOrFail($id);
        return response()->json($feedback);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'feedback_comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->update($request->all());
        return response()->json($feedback, 200);
    }

    public function destroy($id)
    {
        Feedback::destroy($id);
        return response()->json(null, 204);
    }
}