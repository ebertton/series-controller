<?php

namespace Tests\Feature;

use App\Services\SerialRemover;
use App\Services\SeriesCreator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SerialRemoverTest extends TestCase
{
    private $series;

    protected function setUp(): void
    {
        parent::setUp();
        $seriesCreator = new SeriesCreator();
        $this->series = $seriesCreator->seriesCreate(
            'Series name', 
            1, 
            1);

    }


    public function testSerialRemover()
    {
        $this->assertDatabaseHas('series', ['id' => $this->series->id]);
        $serialRemover = new SerialRemover;
        $nameSerie = $serialRemover->seriesRemove($this->series->id);
        $this->assertIsString($nameSerie);
        $this->assertEquals('Series name', $this->series->name);
        $this->assertDatabaseMissing('series', ['id' => $this->series->id]);

    }
}
