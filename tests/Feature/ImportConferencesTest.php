<?php

use App\Models\Conference;
use App\Services\CallingAllPapers;
use Illuminate\Support\Facades\Artisan;
use Mockery\MockInterface;

// Helper function to mock the CallingAllPapers service
function mockCallingAllPapersService(array $conferences)
{
    // See @https://laravel.com/docs/11.x/mocking#mocking-facades
    test()->partialMock(CallingAllPapers::class, function (MockInterface $mock) use ($conferences) {
        $mock->shouldReceive('conferences')->once()->andReturn(['cfps' => $conferences]);
    });
}

// Helper function to run the import command
function runImportCommand()
{
    Artisan::call('cfps:import');
}

beforeEach(function () {
    // Define the initial conference data
    $this->conferenceData = [
        [
            'name' => 'Laravel SaaS Development',
            'uri' => 'https://rajandangi.com.np',
            'dateCfpStart' => '2024-11-19T18:30:00+00:00',
            'dateCfpEnd' => '2024-12-15T18:29:00+00:00',
            'location' => 'Adelaide, Australia',
            'description' => '',
            'dateEventStart' => '2024-12-28T18:30:00+00:00',
            'dateEventEnd' => '2024-12-28T18:30:00+00:00',
            '_rel' => ['cfp_uri' => 'v1/cfp/fkjasdhfsadkf13432432'],
        ],
    ];
});

test('it imports a conference', function () {
    // Mock the service and run the import
    mockCallingAllPapersService($this->conferenceData);
    runImportCommand();

    // Assert the conference was imported
    $this->assertDatabaseHas(Conference::class, [
        'callingallpapers_id' => 'v1/cfp/fkjasdhfsadkf13432432',
    ]);
});

test('it updates a conference', function () {
    // Mock the service and run the import
    mockCallingAllPapersService($this->conferenceData);
    runImportCommand();

    // Assert the conference was created
    $this->assertDatabaseCount(Conference::class, 1);

    // Update the conference data
    $this->conferenceData[0]['name'] = 'Laravel SaaS Development Updated';

    // Mock the service and run the import again
    mockCallingAllPapersService($this->conferenceData);
    runImportCommand();

    // Assert the conference was updated
    $this->assertDatabaseCount(Conference::class, 1)
        ->assertDatabaseHas(Conference::class, [
            'title' => 'Laravel SaaS Development Updated',
        ]);
});
