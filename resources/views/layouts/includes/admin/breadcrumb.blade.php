{{-- Este componente recibe las variables $title y $breadcrumb --}}

<div class="flex justify-between items-center">
    <div>
        {{-- Título de la página --}}
        <h1 class="text-2xl font-bold text-gray-800">{{ $title }}</h1>

        {{-- Breadcrumbs (Migas de pan) --}}
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                @foreach ($breadcrumb as $item)
                    <li class="inline-flex items-center">
                        {{-- Si no es el último elemento, es un enlace. Si es el último, es texto plano y en negrita. --}}
                        @if (!$loop->last)
                            <a href="{{ $item['url'] }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                {{ $item['name'] }}
                            </a>
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                        @else
                            <span class="text-sm font-bold text-gray-800">{{ $item['name'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>