<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ucfirst($dashboardType) }} Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Welcome, {{ $loggedInUser->name }}</h3>
                    <p class="mt-2 text-sm text-gray-600">Email: {{ $loggedInUser->email }}</p>
                    <p class="mt-1 text-sm text-gray-600">Role: {{ ucfirst($loggedInUser->role) }}</p>
                </div>
            </div>

            @if ($dashboardType === 'admin')
                @if (session('apiToken'))
                    <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-green-800">API Token Created Successfully!</h3>
                        <p class="mt-2 text-sm text-gray-700">Copy this token and use it to authenticate API requests. This token provides access to protected endpoints.</p>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Your API Token:</label>
                            <div class="bg-white border border-gray-200 rounded-lg p-4 break-all text-sm text-gray-900 font-mono">{{ session('apiToken') }}</div>
                        </div>
                        <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <h4 class="text-sm font-semibold text-blue-800">How to use this token:</h4>
                            <p class="mt-1 text-sm text-blue-700">Include this token in the Authorization header of your API requests:</p>
                            <code class="block mt-2 p-2 bg-white text-xs text-gray-800 rounded border">Authorization: Bearer {{ session('apiToken') }}</code>
                            <p class="mt-2 text-sm text-blue-700">Example API call:</p>
                            <code class="block mt-1 p-2 bg-white text-xs text-gray-800 rounded border">curl -H "Authorization: Bearer {{ session('apiToken') }}" {{ url('/api/users') }}</code>
                        </div>
                    </div>
                @endif

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">API Token Management</h3>
                        <p class="text-sm text-gray-600 mb-4">Create a personal access token to authenticate API requests. Each token is unique and can be used to access protected endpoints.</p>
                        <form method="POST" action="{{ route('tokens.create') }}">
                            @csrf
                            <div class="grid gap-4 lg:grid-cols-2">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Token Name</label>
                                    <input name="token_name" type="text" value="Admin API Token" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Token name">
                                    <p class="mt-1 text-xs text-gray-500">Choose a descriptive name for your token</p>
                                </div>
                                <div class="flex items-end">
                                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">Create Token</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-semibold mb-4">Users from API</h3>
                            <form method="GET" class="mb-4 grid gap-4 md:grid-cols-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Search Users</label>
                                    <input type="search" name="search" value="{{ $search }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Search by name or email">
                                    <p class="mt-1 text-xs text-gray-500">Enter part of a name or email address</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Filter by Role</label>
                                    <select name="role" class="mt-1 block w-full rounded-md border-gray-300 bg-white py-2 px-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">All roles</option>
                                        <option value="admin" @if($filterRole === 'admin') selected @endif>Admin</option>
                                        <option value="user" @if($filterRole === 'user') selected @endif>User</option>
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500">Filter users by their role</p>
                                </div>
                                <div class="flex items-end">
                                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">Apply Filters</button>
                                </div>
                            </form>

                            @if(count($ownUsers))
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-4 py-2 text-left font-medium text-gray-700">ID</th>
                                                <th class="px-4 py-2 text-left font-medium text-gray-700">Name</th>
                                                <th class="px-4 py-2 text-left font-medium text-gray-700">Email</th>
                                                <th class="px-4 py-2 text-left font-medium text-gray-700">Role</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @foreach($ownUsers as $user)
                                                <tr>
                                                    <td class="px-4 py-2 text-gray-700">{{ $user['id'] }}</td>
                                                    <td class="px-4 py-2 text-gray-700">{{ $user['name'] }}</td>
                                                    <td class="px-4 py-2 text-gray-700">{{ $user['email'] }}</td>
                                                    <td class="px-4 py-2 text-gray-700">{{ ucfirst($user['role']) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-sm text-gray-600">No users returned by the API.</p>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-semibold mb-4">External API Feed</h3>
                            @if(count($externalPosts))
                                <div class="space-y-4">
                                    @foreach($externalPosts as $post)
                                        @if($loop->index >= 5)
                                            @break
                                        @endif
                                        <div class="border border-gray-200 rounded-lg p-4">
                                            <h4 class="font-semibold text-gray-800">{{ $post['title'] }}</h4>
                                            <p class="mt-2 text-sm text-gray-600">{{ \Illuminate\Support\Str::limit($post['body'], 120) }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-600">Unable to load external API data.</p>
                            @endif

                            <div class="mt-6 border-t border-gray-200 pt-6">
                                <h4 class="text-lg font-semibold text-gray-800">Weather snapshot</h4>
                                @if(!empty($weatherForecast['current_weather']))
                                    <p class="mt-2 text-sm text-gray-600">Temperature: {{ $weatherForecast['current_weather']['temperature'] ?? 'N/A' }}°C</p>
                                    <p class="mt-1 text-sm text-gray-600">Wind speed: {{ $weatherForecast['current_weather']['windspeed'] ?? 'N/A' }} km/h</p>
                                    <p class="mt-1 text-sm text-gray-600">Condition: {{ $weatherForecast['current_weather']['weathercode'] ?? 'N/A' }}</p>
                                @else
                                    <p class="text-sm text-gray-600">Weather data is unavailable right now.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @if (session('apiToken'))
                    <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-green-800">API Token Created Successfully!</h3>
                        <p class="mt-2 text-sm text-gray-700">Copy this token and use it to authenticate API requests. This token provides access to protected endpoints.</p>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Your API Token:</label>
                            <div class="bg-white border border-gray-200 rounded-lg p-4 break-all text-sm text-gray-900 font-mono">{{ session('apiToken') }}</div>
                        </div>
                        <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <h4 class="text-sm font-semibold text-blue-800">How to use this token:</h4>
                            <p class="mt-1 text-sm text-blue-700">Include this token in the Authorization header of your API requests:</p>
                            <code class="block mt-2 p-2 bg-white text-xs text-gray-800 rounded border">Authorization: Bearer {{ session('apiToken') }}</code>
                            <p class="mt-2 text-sm text-blue-700">Example API call:</p>
                            <code class="block mt-1 p-2 bg-white text-xs text-gray-800 rounded border">curl -H "Authorization: Bearer {{ session('apiToken') }}" {{ url('/api/users') }}</code>
                        </div>
                    </div>
                @endif

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-semibold mb-4">API Token Management</h3>
                            <p class="text-sm text-gray-600 mb-4">Create a personal access token to authenticate API requests. Each token is unique and can be used to access protected endpoints.</p>
                            <form method="POST" action="{{ route('tokens.create') }}">
                                @csrf
                                <div class="grid gap-4 lg:grid-cols-2">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Token Name</label>
                                        <input name="token_name" type="text" value="User API Token" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Token name">
                                        <p class="mt-1 text-xs text-gray-500">Choose a descriptive name for your token</p>
                                    </div>
                                    <div class="flex items-end">
                                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">Create Token</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-semibold mb-4">Weather snapshot</h3>
                            @if(!empty($weatherForecast['current_weather']))
                                <p class="text-sm text-gray-600">Temperature: {{ $weatherForecast['current_weather']['temperature'] ?? 'N/A' }}°C</p>
                                <p class="mt-1 text-sm text-gray-600">Wind speed: {{ $weatherForecast['current_weather']['windspeed'] ?? 'N/A' }} km/h</p>
                                <p class="mt-1 text-sm text-gray-600">Condition: {{ $weatherForecast['current_weather']['weathercode'] ?? 'N/A' }}</p>
                            @else
                                <p class="text-sm text-gray-600">Weather data is unavailable right now.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">User dashboard</h3>
                        <p class="text-sm text-gray-600">This dashboard area is reserved for regular users. If you need admin access, please contact your administrator.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
