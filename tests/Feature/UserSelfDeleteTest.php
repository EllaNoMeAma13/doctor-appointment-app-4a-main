<?php

use App\Models\User;

test('authenticated user cannot delete their own account', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->delete(route('admin.users.destroy', $user));

    $response->assertStatus(403);
    $this->assertDatabaseHas('users', ['id' => $user->id]);
});
