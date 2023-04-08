<?php

namespace App\Services;

use App\Models\Season;
use App\Models\Serie;
use Illuminate\Support\Facades\DB;

class SeriesCreator
{
    public function seriesCreate (string $seriesName, int $seasonNumber, int $epSeason)
    {
        $serie = new Serie();
        DB::beginTransaction();
        $serie =  Serie::create(['name' => $seriesName]);
        $this->seasonCreate($seasonNumber, $serie, $epSeason);
        DB::commit();
       
        return $serie;
    }
    private function seasonCreate( int $seasonNumber, Serie $serie, int $epSeason): void
    {
        for($i = 1; $i <= $seasonNumber; $i++) {
            $season = $serie->seasons()->create(['number' => $i]);
            $this->episodeCreate($epSeason, $season);
        }
    }

    private function episodeCreate(int $epSeason, Season $season): void
    {
        for ($j = 1; $j <= $epSeason; $j++) {
            $episode = $season->episodes()->create(['number' => $j]);
        }
    }
}