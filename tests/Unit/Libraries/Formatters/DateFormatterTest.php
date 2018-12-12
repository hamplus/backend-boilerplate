<?php

namespace Tests\Unit\Libraries\Formatters;

use App\Hamsaa\Libraries\Formatters\DateFormatter;
use Carbon\Carbon;
use Tests\TestCase;

class DateFormatterTest extends TestCase
{
    /** @test */
    public function does_it_generate_a_correct_date_format_for_a_given_carbon()
    {
        $mockedDate = Carbon::create(2000, 1, 1, 12, 0, 0);
        Carbon::setTestNow(Carbon::create(2018, 1, 1, 12, 0, 0));
        $dateFormatter = new DateFormatter($mockedDate);
        $this->assertEquals([
                'timestamp' => 946728000,
                'jalali' => 'شنبه ۱۱ دی ۱۳۷۸ ساعت ۱۲:۰۰:۰۰',
                'gregorian' => 'Saturday 01 January 2000 12:00:00',
                'human_readable' => '۱۸ سال پیش'
            ], $dateFormatter->format());
    }

    /** @test */
    public function does_it_return_null_for_null_date()
    {
        $dateFormatter = new DateFormatter(null);
        $this->assertNull($dateFormatter->format());
    }
}
