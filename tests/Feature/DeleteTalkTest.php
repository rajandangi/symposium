<?php

use App\Models\Talk;
use App\Models\User;

test('a user can delete their talk', function () {
    $talk = Talk::factory()->create();

    $response = $this->actingAs($talk->author)
        ->delete(route('talks.destroy', ['talk' => $talk]));

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('talks.index'));

    $this->assertDatabaseMissing(Talk::class, ['id' => $talk->id]);
});

test('a user cannot delete another users talk', function () {
    $talk = Talk::factory()->create();
    $otherUser = User::factory()->create();

    $originalTitle = $talk->title;

    $response = $this->actingAs($otherUser)
        ->delete(route('talks.destroy', ['talk' => $talk]));

    $response->assertForbidden();

    $this->assertEquals($originalTitle, $talk->refresh()->title);
});
