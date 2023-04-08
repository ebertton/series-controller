<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use \Illuminate\Support\Facades\Mail;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;
use App\Services\SerialRemover;
use App\Services\SeriesCreator;
use Illuminate\Http\Request;
use \App\Mail\NewSeries;
use App\Models\User;

class SeriesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

   

    public function index (Request $request){
        $series = Serie::query()->orderBy('name')->get();
        $message = $request->session()->get('message');
        $request->session()->remove('message');
        return view('series.index', compact('series', 'message'));
    }
    public function create(){
        return view('series.create');
    }
    public function store (SeriesFormRequest $request, SeriesCreator $seriesCreator){
        $series = $seriesCreator->seriesCreate($request->name, $request->season_number, $request->ep_season);
        $users = User::all();
        foreach ($users as $index => $user) {
            $multiplier = $index + 1;
            $email = new NewSeries($request->name, $request->season_number, $request->ep_season);
            $email->subject('New series add');
            $when = now()->addSecond($multiplier * 10);
            Mail::to($user)->later($when,$email);
            //sleep(5);
        }
        $request->session()->flash('message', "Series {$series->id} and your seasons and episodes suas temn created with succes {$series->name}");
        return redirect()->route('list_series');
    }
    public function destroy(Request $request, SerialRemover $serialRemover){
        $seriesName = $serialRemover->seriesRemove($request->id);
        $request->session()->flash('message', "Series {$seriesName} removed with succes");
        return redirect()->route('list_series');
    }
    public function update(int $id, Request $request)
    {
        $newName = $request->name;
        $series = Serie::find($id);
        $series->name = $newName;
        $series->save();
    }
}
