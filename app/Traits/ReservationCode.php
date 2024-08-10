<?php

namespace App\Traits;

trait ReservationCode
{
    public function create_code(): string
    {
        $code = '';

        for ($i = 0; $i < 4; $i++) {
            if ($i > 0) {
                $code .= '-';
            }
            $partial = \Illuminate\Support\Str::random(4);
            $code .= $partial;
        }

        return $code;
    }
}
