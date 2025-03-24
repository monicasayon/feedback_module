<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::with('user')->get();
        $feedback = $feedback->map(function($feedback) {
            return [
                'user_name' => $feedback->user->name,
                'user_email' => $feedback->user->email,
                'feedback_comment' => $feedback->feedback_comment,
                'rating' => $feedback->rating,
                'created_at' => $feedback->created_at,
            ];
        });
        return response()->json($feedback);


        $query = Feedback::query();

        // Filtering
        if ($request->has('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }
        if ($request->has('rating')) {
            $query->where('rating', $request->input('rating'));
        }
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->input('start_date'), $request->input('end_date')]);
        }

        // Sorting
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
            $sortOrder = $request->input('sort_order', 'asc');
            $query->orderBy($sortBy, $sortOrder);
        }

        $feedback = $query->get();
        return response()->json($feedback);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'feedback_comment' => 'required|string',
            'rating' => 'required|integer|between:1,5',
            'user_id' => 'required|integer|exists:users,id'
        ]);

        $feedback = Feedback::create($validatedData);

        return response()->json(['message' => 'Feedback submitted successfully', 'feedback' => $feedback], 201);
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

    public function averageRating()
    {
        $averageRating = Feedback::avg('rating');
        return response()->json(['average_rating' => $averageRating]);
    }
}