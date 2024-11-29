<?php

use App\Models\Conference;
use App\Models\User;

test('it favourites a conference', function () {
    $conference = Conference::factory()->create();
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('conferences.favourite', ['conference' => $conference]));

    $this->assertCount(1, $user->favouritedConferences);
    $this->assertTrue($user->favouritedConferences->pluck('id')->contains($conference->id));
});

test('it unfavourites a conference', function () {
    $conference = Conference::factory()->create();
    $user = User::factory()->create();

    $user->favouritedConferences()->attach($conference);

    $this->actingAs($user)
        ->delete(route('conferences.unfavourite', ['conference' => $conference]));

    $this->assertCount(0, $user->favouritedConferences);
});
