<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

test('authenticated user can update a user record', function () {
    $user = User::factory()->create();
    $role = Role::create(['name' => 'admin']);

    $this->actingAs($user);

    $response = $this->put(route('admin.users.update', $user), [
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
        'roles' => [$role->id],
    ]);

    $response->assertRedirect(route('admin.users.index'));
    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
    ]);
});

test('update fails with invalid data', function () {
    $user = User::factory()->create();
    $role = Role::create(['name' => 'admin']);

    $this->actingAs($user);

    $response = $this->put(route('admin.users.update', $user), [
        'name' => '', // Invalid name
        'email' => 'not-an-email', // Invalid email
        'roles' => [$role->id],
    ]);

    $response->assertSessionHasErrors(['name', 'email']);
});
