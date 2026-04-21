<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Ticket de Soporte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <strong>ID:</strong> {{ $supportTicket->id }}
                </div>
                <div class="mb-4">
                    <strong>Usuario:</strong> {{ $supportTicket->user->name }}
                </div>
                <div class="mb-4">
                    <strong>Asunto:</strong> {{ $supportTicket->subject }}
                </div>
                <div class="mb-4">
                    <strong>Mensaje:</strong>
                    <div class="mt-2 p-4 bg-gray-100 rounded">
                        {!! nl2br(e($supportTicket->message)) !!}
                    </div>
                </div>
                <div class="mb-4">
                    <strong>Estado Actual:</strong>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $supportTicket->status === 'open' ? 'green' : ($supportTicket->status === 'in_progress' ? 'yellow' : 'red') }}-100 text-{{ $supportTicket->status === 'open' ? 'green' : ($supportTicket->status === 'in_progress' ? 'yellow' : 'red') }}-800">
                        {{ ucfirst(str_replace('_', ' ', $supportTicket->status)) }}
                    </span>
                </div>

                <div class="mt-6 border-t pt-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Actualizar Estado</h3>
                    <form action="{{ route('admin.support-tickets.update', $supportTicket) }}" method="POST" class="flex items-center">
                        @csrf
                        @method('PUT')
                        <select name="status" class="mr-2 shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="open" {{ $supportTicket->status === 'open' ? 'selected' : '' }}>Abierto</option>
                            <option value="in_progress" {{ $supportTicket->status === 'in_progress' ? 'selected' : '' }}>En Progreso</option>
                            <option value="closed" {{ $supportTicket->status === 'closed' ? 'selected' : '' }}>Cerrado</option>
                        </select>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Actualizar
                        </button>
                    </form>
                </div>

                <div class="mt-6">
                    <a href="{{ route('admin.support-tickets.index') }}" class="text-blue-500 hover:text-blue-800">Volver a la lista</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
