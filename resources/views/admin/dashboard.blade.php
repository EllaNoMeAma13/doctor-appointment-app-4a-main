<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
        'active' => request()->routeIs('admin.dashboard'),
    ],
    [
        'name' => 'Profile',
        'href' => route('profile.show'),
        'active' => request()->routeIs('profile.show'),
    ],
]">
    Hola desde admin

    <div class="mt-4">
        <x-button label="Test de WireUI" primary />
    </div>

</x-admin-layout>
