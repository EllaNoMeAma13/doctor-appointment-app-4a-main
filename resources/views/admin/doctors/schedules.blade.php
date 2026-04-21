<x-admin-layout title="Gestionar Horarios del Doctor" :breadcrumb="[
    ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['name' => 'Doctores', 'url' => route('admin.doctors.index')],
    ['name' => $doctor->name, 'url' => route('admin.doctors.edit', $doctor)],
    ['name' => 'Horarios']
]">

    <div class="p-6 mb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800">Horarios de {{ $doctor->name }}</h2>
    </div>

    <!-- Bloque para mostrar errores de validación -->
    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">¡Ups!</strong>
            <span class="block sm:inline">Ocurrieron algunos errores al guardar los horarios.</span>
            <ul class="mt-3 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.doctors.schedules.store', $doctor) }}" method="POST">
        @csrf
        <x-card>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                    $schedules = $doctor->doctor->schedules->keyBy('day_of_week');
                @endphp
                @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $day)
                    @php
                        $schedule = $schedules->get($day);
                    @endphp
                    <div>
                        <h3 class="text-lg font-semibold mb-2">{{ $day }}</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input type="time" name="schedules[{{ $day }}][start_time]" label="Hora de inicio" value="{{ old('schedules.'.$day.'.start_time', $schedule->start_time ?? '') }}" />
                                @error('schedules.'.$day.'.start_time')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <x-input type="time" name="schedules[{{ $day }}][end_time]" label="Hora de fin" value="{{ old('schedules.'.$day.'.end_time', $schedule->end_time ?? '') }}" />
                                @error('schedules.'.$day.'.end_time')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-2">
                            @php
                                $oldStatusKey = 'schedules.' . $day . '.status';
                                $isSavedAsActive = ($schedule->status ?? '') === 'active';

                                if (session()->hasOldInput()) {
                                    $isChecked = old($oldStatusKey) !== null;
                                } else {
                                    $isChecked = $isSavedAsActive;
                                }
                            @endphp
                            <x-checkbox name="schedules[{{ $day }}][status]" label="Activo" value="active" :checked="$isChecked" />
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex justify-end">
                <x-button type="submit" label="Guardar Horarios" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-md font-semibold text-xs uppercase" />
            </div>
        </x-card>
    </form>

</x-admin-layout>
