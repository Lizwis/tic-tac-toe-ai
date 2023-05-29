<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;

class ScoresController extends Controller
{
    public function topPlayers()
    {

        $topPlayers = Score::select('name')
            ->selectRaw('SUM(score) as total_score')
            ->groupBy('name')
            ->orderByDesc('total_score')
            ->limit(10)
            ->get();

        return response()->json($topPlayers, 200);
    }

    public function saveScore(Request $request)
    {
        $score = 0;

        if ($request->winner == 'X') {
            $score = 1;
        }

        $score = Score::create([
            'name' => $request->playerName,
            'score' =>  $score,
        ]);

        return response()->json($score, 200);
    }
}
