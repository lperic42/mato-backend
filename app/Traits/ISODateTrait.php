<?php

namespace App\Traits;

use Illuminate\Support\Carbon;

trait ISODateTrait
{

    protected function serializeDate(\DateTimeInterface $date)
    {
        return [
            'carbonDate' => Carbon::instance($date)->toJSON(),
            'isoDate' => $date->format('c'),
            'date' => $date->format('Y-m-d H:i:s'),
            'adminDate' => $date->format('d.m.Y'),
            'timezone' => $date->timezone
        ];
    }

    protected function asDateTime($value) {
        if(is_array($value) && isset($value['carbonDate'])) {
            return parent::asDateTime($value['carbonDate']);
        }
        return  parent::asDateTime($value);
    }

}
