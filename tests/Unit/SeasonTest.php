<?php

namespace Tests\Unit;

use App\Models\Episode;
use App\Models\Season;
use Tests\TestCase;

class SeasonTest extends TestCase
{
    private $season;

    protected function setUp(): void
    {
        parent::setUp();
        $season = new Season();
        $episode1 = new Episode();
        $episode1->visualized = true;
        $episode2 = new Episode();
        $episode2->visualized = false;
        $episode3 = new Episode();
        $episode3->visualized = true;
        $season->episodes->add($episode1);
        $season->episodes->add($episode2);
        $season->episodes->add($episode3);

        $this->season = $season;
    }
    
    public function test_exemple()
    {
        $episodesVisualized = $this->season->getEpisodesVisualized();
        $this->assertCount(2, $episodesVisualized);
        foreach($episodesVisualized as $episode) {
            $this->assertTrue($episode->visualized);
        }
    }

    public function testGetAllEpisodes()
{
    $episodes = $this->season->episodes;
    $this->assertCount(3, $episodes);
}
}
