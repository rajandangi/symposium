<?php

use App\Enums\TalkType;
use App\Models\Talk;
use App\Models\User;

test('a user can update their talk', function () {
    $talk = Talk::factory()->create();

    $response = $this->actingAs($talk->author)
        ->patch(route('talks.update', ['talk' => $talk]), [
            'title' => 'Rajan Updated Talk',
            'type' => TalkType::KEYNOTE->value,
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('talks.show', ['talk' => $talk]));

    $this->assertDatabaseHas(Talk::class, ['title' => 'Rajan Updated Talk']);
});

test('a user cannot update another users talk', function () {
    $talk = Talk::factory()->create();
    $otherUser = User::factory()->create();

    $originalTitle = $talk->title;

    $response = $this->actingAs($otherUser)
        ->patch(route('talks.update', ['talk' => $talk]), [
            'title' => 'Rajan Updated Talk',
            'type' => TalkType::KEYNOTE->value,
        ]);

    $response->assertForbidden();

    $this->assertEquals($originalTitle, $talk->refresh()->title);
});
