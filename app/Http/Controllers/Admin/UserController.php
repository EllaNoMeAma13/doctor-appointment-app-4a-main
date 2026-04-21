<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'id_number' => 'nullable|string|max:255|unique:users',
            'phone' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'id_number' => $request->id_number,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        $user->roles()->sync($request->roles);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Hecho!',
            'text' => 'Usuario creado satisfactoriamente.'
        ]);

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'id_number' => 'nullable|string|max:255|unique:users,id_number,' . $user->id,
            'phone' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array'
        ]);

        $data = $request->only('name', 'email', 'id_number', 'phone');

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        $user->roles()->sync($request->roles);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Hecho!',
            'text' => 'Usuario actualizado satisfactoriamente.'
        ]);

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            abort(403, 'No puedes eliminar tu propia cuenta.');
        }

        $user->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Hecho!',
            'text' => 'Usuario eliminado satisfactoriamente.'
        ]);

        return redirect()->route('admin.users.index');
    }
}
