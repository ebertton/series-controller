<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function index(Season $season, Request $request)
    {
        $episodes = $season->episodes;
        $seasonId = $season->id;
        $message = $request->session()->get('message');
        return view('episodes.index', compact('episodes', 'seasonId', 'message'));
    }

    public function update(Season $season, Request $request)
    {
        $episodesVisualized = $request->episodes;
        $season->episodes->each(function (Episode $episode) use($episodesVisualized){

            $episode->visualized = in_array($episode->id, $episodesVisualized);
        });
        $season->push(); //Envias todas as alterações da season e suas ligações para o banco de uma unica fez
        $request->session()->flash('message', 'Episodes visualized salved!');
        return redirect()->back();
    }
}
