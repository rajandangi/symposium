<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CallingAllPapers
{
    protected $baseUrl = 'https://api.callingallpapers.com/v1/';

    public function conferences(): array
    {
        // See @https://laravel.com/docs/11.x/http-client
        return Http::get($this->baseUrl . 'cfp')->json();
    }
}
