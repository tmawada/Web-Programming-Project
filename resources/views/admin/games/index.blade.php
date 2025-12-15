<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-cyber-primary leading-tight">
                {{ __('Manage Games') }}
            </h2>
            <a href="{{ route('admin.games.create') }}" class="bg-cyber-primary text-white px-4 py-2 rounded shadow hover:bg-cyber-secondary transition">
                Add New Game
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-cyber-alt overflow-hidden shadow-sm sm:rounded-lg border border-cyber-secondary/30">
                <div class="p-6 text-cyber-text">
                    @if(session('success'))
                        <div class="bg-green-500/20 text-green-400 p-4 rounded mb-4 border border-green-500/50">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full divide-y divide-cyber-secondary/30">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-cyber-bg text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 bg-cyber-bg text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Genre</th>
                                <th class="px-6 py-3 bg-cyber-bg text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 bg-cyber-bg text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cyber-secondary/30">
                            @foreach($games as $game)
                                <tr class="hover:bg-cyber-secondary/10 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $game->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $game->genre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ $game->price }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.games.edit', $game) }}" class="text-cyber-primary hover:text-cyber-secondary mr-3">Edit</a>
                                        <form action="{{ route('admin.games.destroy', $game) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $games->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
