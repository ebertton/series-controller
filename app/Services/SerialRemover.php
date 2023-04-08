<?php

namespace App\Services;

use App\Models\{Episode, Season, Serie};
use Illuminate\Support\Facades\DB;

class SerialRemover
{
    public function seriesRemove(int $seriesId): string
    {
        $seriesName = '';
        DB::transaction(function () use ($seriesId, &$seriesName) { // utilizando o use o PHP pega uma copia da varival para ser executada dentro da função anonima e com o & o PHP faz com que todas as alterações realizadas na variavel sejam refletidas fora da função
            $series = Serie::find($seriesId);
            $seriesName = $series->name;
            $this->seasonRemove($series);
            $series->delete();
            
        });

        return $seriesName;
    }
    private function seasonRemove(Serie $series): void
    {
        $series->seasons->each(function (Season $season) { // O each() vai executar uma função pra cada objeto da lista
            $this->episodesRemove($season);
            $season->delete();
        });
        
    }

    private function episodesRemove(Season $season): void
    {
        $season->episodes->each(function (Episode $episode) {
            $episode->delete();
        });
        
    }
}