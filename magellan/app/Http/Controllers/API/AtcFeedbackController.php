<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AtcFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AtcFeedbackController extends Controller
{
    /**
     * Store a new feedback from the ATC training app
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'feedback_type' => 'required|string|in:country,ifr,airports',
            'country' => 'nullable|string|required_if:feedback_type,country',
            'airports' => 'nullable|string|required_if:feedback_type,airports',
            'comments' => 'nullable|string',
            'device_id' => 'nullable|string',
            'app_version' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $feedback = AtcFeedback::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Feedback received successfully',
            'data' => $feedback
        ], 201);
    }

    /**
     * Get all feedback submissions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $feedback = AtcFeedback::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $feedback
        ]);
    }
}
