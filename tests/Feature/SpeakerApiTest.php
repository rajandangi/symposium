<?php

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

test('it gets speakers', function () {
    User::factory(3)->create();
    $firstUser = User::first();

    $response = $this->get('/api/speakers');

    $response->assertJson(
        fn (AssertableJson $json) => $json->has('data', 3)
            ->where('data.0.name', $firstUser->name)
    );
});
