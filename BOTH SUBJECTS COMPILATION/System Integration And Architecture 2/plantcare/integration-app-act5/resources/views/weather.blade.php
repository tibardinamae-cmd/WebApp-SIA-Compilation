<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Weather Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Weather Snapshot</h3>

                    @if(!empty($weatherForecast['current_weather']))
                        <p class="text-sm text-gray-700">Temperature: {{ $weatherForecast['current_weather']['temperature'] ?? 'N/A' }}°C</p>
                        <p class="text-sm text-gray-700 mt-2">Wind speed: {{ $weatherForecast['current_weather']['windspeed'] ?? 'N/A' }} km/h</p>
                        <p class="text-sm text-gray-700 mt-2">Weather code: {{ $weatherForecast['current_weather']['weathercode'] ?? 'N/A' }}</p>
                    @else
                        <p class="text-sm text-gray-600">Weather data is unavailable right now.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
