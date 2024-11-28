<?php

use App\Enums\TalkType;
use App\Models\Talk;
use App\Models\User;

test('a user create a talk', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->Post(route('talks.store'), [
            'title' => 'My First Talk',
            'length' => '30',
            'type' => TalkType::KEYNOTE->value,
            'abstract' => 'This is my first talk',
            'organizer_notes' => 'Please accept this talk',
        ]);

    $response->assertRedirect(route('talks.index'));

    $this->assertDatabaseHas(Talk::class, [
        'title' => 'My First Talk',
    ]);
});
