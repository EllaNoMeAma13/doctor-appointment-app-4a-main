<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index');
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        $role = Role::create(['name' => $request->name]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Rol creado correctamente',
            'text' => 'El rol ha sido creado exitosamente.'
        ]);

        return redirect()->route('admin.roles.index');
    }

    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        if (in_array($role->id, [1, 2, 3, 4])) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Acción no permitida',
                'text' => 'No puedes editar.'
            ]);
            return redirect()->route('admin.roles.index');
        }
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        if (in_array($role->id, [1, 2, 3, 4])) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'No puedes editar este rol.'
            ]);
            return redirect()->route('admin.roles.index');
        }

        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id
        ]);

        $role->update(['name' => $request->name]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Rol actualizado',
            'text' => 'El rol ha sido actualizado exitosamente.'
        ]);

        return redirect()->route('admin.roles.index');
    }

    public function destroy(Role $role)
    {
        if (in_array($role->id, [1, 2, 3, 4])) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'No puedes eliminar este rol.'
            ]);
            return redirect()->route('admin.roles.index');
        }

        $role->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Rol eliminado',
            'text' => 'El rol ha sido eliminado exitosamente.'
        ]);

        return redirect()->route('admin.roles.index');
    }
}
