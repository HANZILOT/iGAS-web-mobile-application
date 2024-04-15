<?php

namespace App\Http\Controllers\User;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\GasolineStation;
use App\Http\Controllers\Controller;

class RatingController extends Controller
{
    public function __invoke(Request $request, GasolineStation $gasoline_station)
    {
        $data = $request->validate([
            'rating' => 'required',
            'comment' => 'required',
        ]);

        // Check if the user has already submitted a rating
        $check_rating = Rating::where('gasoline_station_id', $gasoline_station->id)
            ->where('user_id', auth()->id())
            ->whereMonth('created_at', now())
            ->first();

        if ($check_rating) {
            return back()->with(['error' => 'Sorry, you can only rate this gasoline station once a month. Your previous rating is still valid.']);
        }

        $rating = $gasoline_station->ratings()->create($data + ['user_id' => auth()->id()]);

        // Retrieve ratings and reviews information for the current gasoline station
        $averageRating = $gasoline_station->averageRating();
        $numberOfReviews = $gasoline_station->numberOfReviews();

        // Log the activity for the new rating
        $this->log_activity(
            model: $rating,
            event: 'added',
            model_name: 'Rating',
            model_property_name: $rating->rating . ' for ' . $rating->gasoline_station->name,
            end_user: $rating->user->full_name
        );

        return back()->with([
            'success' => 'Thank you for your feedback. Your rating has been submitted successfully',
            'averageRating' => $averageRating, // Pass average rating to the view
            'numberOfReviews' => $numberOfReviews, // Pass number of reviews to the view
        ]);
    }
}
