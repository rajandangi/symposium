<?php

namespace App\Console\Commands;

use App\Models\Conference;
use App\Services\CallingAllPapers;
use DateTime;
use Illuminate\Console\Command;

class ImportConferences extends Command
{
    /**
     * The name and signature of the console command.
     * We can run this command by typing php artisan cfps:import in the terminal.
     *
     * @var string
     */
    protected $signature = 'cfps:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will import list of currently open Calls for Papers (CFP) from callingallpapers.com';

    /**
     * Execute the console command.
     */
    public function handle(CallingAllPapers $cfps)
    {
        foreach ($cfps->conferences()['cfps'] as $conference) {
            $this->importOrUpdateConference($conference);
        }
    }

    /**
     * Import or update a conference.
     */
    protected function importOrUpdateConference(array $conference)
    {
        // 1. An array of attributes to search for an existing record.
        // 2. An array of attributes to update if the record exists or to create if it doesn't.
        Conference::updateOrCreate(
            ['callingallpapers_id' => $conference['_rel']['cfp_uri']],
            [
                'title' => $conference['name'],
                'location' => $conference['location'],
                'description' => $conference['description'],
                'url' => $conference['uri'],
                'starts_at' => (new DateTime($conference['dateEventStart']))->format('Y-m-d H:i:s'),
                'ends_at' => (new DateTime($conference['dateEventEnd']))->format('Y-m-d H:i:s'),
                'cfp_starts_at' => (new DateTime($conference['dateCfpStart']))->format('Y-m-d H:i:s'),
                'cfp_ends_at' => (new DateTime($conference['dateCfpEnd']))->format('Y-m-d H:i:s'),
            ]
        );
    }
}
