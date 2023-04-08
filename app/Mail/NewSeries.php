<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewSeries extends Mailable
{
    use Queueable, SerializesModels;

    public String $name;
    public int $numberOfSeasons;
    public int $numberOfEpisodes;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $name, int $numberOfSeasons ,int $numberOfEpisodes)
    {
        $this->name = $name;
        $this->numberOfSeasons = $numberOfSeasons;
        $this->numberOfEpisodes = $numberOfEpisodes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.series.new-series');
    }
}
