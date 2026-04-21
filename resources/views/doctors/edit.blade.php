<x-admin-layout title="Editar Información del Doctor" :breadcrumb="[
    ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['name' => 'Doctores', 'url' => route('doctors.index')],
    ['name' => $user->name]
]">

    {{-- Header with Title and Action Buttons --}}
    <div class="p-6 mb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-4">
            {{-- Avatar --}}
            <div class="w-16 h-16 bg-blue-100 text-blue-500 rounded-full flex items-center justify-center text-2xl font-bold">
                {{ substr($user->name, 0, 2) }}
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                <div class="text-sm text-gray-500 mt-1 flex flex-col sm:flex-row sm:gap-4">
                    <p>
                        <span class="font-semibold text-gray-700">Cédula:</span>
                        {{ $user->doctor->medical_license_number ?? 'N/A' }}
                    </p>
                    <p>
                        <span class="font-semibold text-gray-700">Biografía:</span>
                        {{ empty($user->doctor->biography) ? 'N/A' : Str::limit($user->doctor->biography, 50) }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex gap-3">
            <x-button href="{{ route('doctors.index') }}" label="Volver" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-md font-semibold text-xs uppercase" />
            <x-button type="submit" form="edit-doctor-form" label="Guardar cambios" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-md font-semibold text-xs uppercase" />
        </div>
    </div>

    {{-- Form --}}
    <form action="{{ route('doctors.update', $user->id) }}" method="POST" id="edit-doctor-form">
        @csrf
        @method('PUT')

        <x-card title="Información Médica y Profesional">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Specialty --}}
                <div>
                    <x-native-select
                        label="Especialidad *"
                        name="specialty_id"
                        :options="$specialities"
                        option-label="name"
                        option-value="id"
                        :value="old('specialty_id', $user->doctor->specialty_id ?? '')"
                    />
                </div>

                {{-- Medical License --}}
                <div>
                    <x-input
                        label="Cédula Profesional *"
                        name="medical_license_number"
                        placeholder="Ej. 1234567"
                        :value="old('medical_license_number', $user->doctor->medical_license_number ?? '')"
                    />
                </div>

                {{-- Biography --}}
                <div class="md:col-span-2">
                    <x-textarea
                        label="Biografía *"
                        name="biography"
                        placeholder="Escribe una breve biografía del doctor..."
                        rows="4"
                    >{{ old('biography', $user->doctor->biography ?? '') }}</x-textarea>
                </div>

            </div>
        </x-card>
    </form>

    {{-- Banner for notifications --}}
    @if (session('flash.banner'))
        <x-banner message="{{ session('flash.banner') }}" style="{{ session('flash.bannerStyle') }}" />
    @endif

</x-admin-layout>
