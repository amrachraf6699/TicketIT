<?php

namespace App\Traits;

use Spatie\LaravelPdf\Facades\Pdf;

trait GeneratePDF
{
    public function generatePDF($reservation)
    {
        $path = 'tickets/' . \Illuminate\Support\Str::uuid() . '.pdf';

        Pdf::view('pdf.reservation', compact('reservation'))
            ->save(public_path($path));

        return $path;
    }

    public function SpeakersTicket($user)
    {
        $path = 'tickets/' . \Illuminate\Support\Str::uuid() . '.pdf';

        Pdf::view('pdf.speaker_id', compact('user'))
            ->save(public_path($path));

        return $path;
    }
}
