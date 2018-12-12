<?php

namespace App\Hamsaa\Libraries\Formatters;

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

class DateFormatter implements Formatter
{
    private $date;

    public function __construct(?Carbon $date)
    {
        $this->date = $date;
    }

    public function format()
    {
        if (!$this->date) {
            return null;
        }
        return [
            'timestamp' => $this->date->timestamp,
            'jalali' => \Morilog\Jalali\CalendarUtils::convertNumbers(
                Jalalian::fromCarbon($this->date)->format('l %d %B Y ساعت H:i:s')
            ),
            'gregorian' => $this->date->format('l d F Y H:i:s'),
            'human_readable' => \Morilog\Jalali\CalendarUtils::convertNumbers($this->date->diffForHumans()),
        ];
    }
}
