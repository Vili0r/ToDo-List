<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class CompletedController extends Controller
{
    public function index()
    {
        $completed = Todo::where('user_id', auth()->id())
                ->where('completed', 1)->get();
        $priorities = [
            [
                'label' => 'Low Priority',
                'value' => 'low',
            ],
            [
                'label' => 'Medium Priority',
                'value' => 'medium',
            ],
            [
                'label' => 'High Priority',
                'value' => 'high',
            ]
        ];

        return view('completed.index', compact('priorities', 'completed'));
    }
}
