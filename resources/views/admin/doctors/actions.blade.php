<div x-data="{ showModal: false }" class="flex items-center space-x-2">
    {{-- Edit Button --}}
    <a href="{{ route('admin.doctors.edit', $user) }}" class="p-1 text-white bg-blue-500 rounded hover:bg-blue-700" title="Editar Información del Doctor">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
        </svg>
    </a>

    {{-- Clock Icon Button --}}
    <button @click="showModal = true" class="p-1 text-white bg-green-500 rounded hover:bg-green-700" title="Ver Horarios">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.414-1.414L11 10.586V6z" clip-rule="evenodd" />
        </svg>
    </button>

    {{-- Modal --}}
    <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click.away="showModal = false">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg" @click.stop>
            <h3 class="text-xl font-semibold mb-4">Horarios de {{ $user->name }}</h3>

            <div class="space-y-2">
                @forelse ($user->doctor->schedules ?? [] as $schedule)
                    <div class="flex justify-between p-2 rounded {{ $schedule->status === 'active' ? 'bg-green-100' : 'bg-gray-100' }}">
                        <span class="font-semibold">{{ $schedule->day_of_week }}</span>
                        <span>{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</span>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $schedule->status === 'active' ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-800' }}">
                            {{ ucfirst($schedule->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500">Este doctor aún no tiene horarios guardados.</p>
                @endforelse
            </div>

            <div class="mt-6 text-right">
                <button @click="showModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
