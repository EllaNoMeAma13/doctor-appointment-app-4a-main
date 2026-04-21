<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

test('authenticated user can create a user record', function () {
    $user = User::factory()->create();
    $role = Role::create(['name' => 'admin']);

    $this->actingAs($user);

    $response = $this->post(route('admin.users.store'), [
        'name' => 'New User',
        'email' => 'newuser@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'roles' => [$role->id],
    ]);

    $response->assertRedirect(route('admin.users.index'));
    $this->assertDatabaseHas('users', [
        'email' => 'newuser@example.com',
    ]);
});

test('create fails with invalid data', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->post(route('admin.users.store'), [
        'name' => '',
        'email' => 'not-an-email',
    ]);

    $response->assertSessionHasErrors(['name', 'email', 'password', 'roles']);
});
