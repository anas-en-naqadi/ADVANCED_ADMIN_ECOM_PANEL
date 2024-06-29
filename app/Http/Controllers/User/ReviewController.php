<?php



namespace App\Http\Controller\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user')->get(['rating', 'review_text']);
        return response()->json($reviews);
    }

    public function store(ReviewRequest $request)
    {
        $validatedData = $request->validated();
        CleanInputs($validatedData);

        $validatedData['user_id'] = getSimpleUser()->id;
        $review = Review::create($validatedData);

        return $review
            ? response()->json(['message' => 'Review added successfully'], 200)
            : response()->json(['message' => 'Failed to add review'], 500);
    }

}
