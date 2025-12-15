<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyber-primary leading-tight">
            {{ __('Edit Game') }}: {{ $game->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-cyber-alt shadow-sm sm:rounded-lg border border-cyber-secondary/30 p-6">
                <form action="{{ route('admin.games.update', $game) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-400">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $game->title) }}" class="mt-1 block w-full bg-cyber-bg border-cyber-secondary text-cyber-text rounded-md shadow-sm focus:ring-cyber-primary focus:border-cyber-primary" required>
                        </div>

                        <!-- Genre -->
                        <div>
                            <label for="genre" class="block text-sm font-medium text-gray-400">Genre</label>
                            <input type="text" name="genre" id="genre" value="{{ old('genre', $game->genre) }}" class="mt-1 block w-full bg-cyber-bg border-cyber-secondary text-cyber-text rounded-md shadow-sm focus:ring-cyber-primary focus:border-cyber-primary" required>
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-400">Price ($)</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $game->price) }}" class="mt-1 block w-full bg-cyber-bg border-cyber-secondary text-cyber-text rounded-md shadow-sm focus:ring-cyber-primary focus:border-cyber-primary" required>
                        </div>

                        <!-- Platform -->
                        <div>
                            <label for="platform" class="block text-sm font-medium text-gray-400">Platform</label>
                            <input type="text" name="platform" id="platform" value="{{ old('platform', $game->platform) }}" class="mt-1 block w-full bg-cyber-bg border-cyber-secondary text-cyber-text rounded-md shadow-sm focus:ring-cyber-primary focus:border-cyber-primary" required>
                        </div>

                        <!-- Publisher -->
                        <div>
                            <label for="publisher" class="block text-sm font-medium text-gray-400">Publisher</label>
                            <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $game->publisher) }}" class="mt-1 block w-full bg-cyber-bg border-cyber-secondary text-cyber-text rounded-md shadow-sm focus:ring-cyber-primary focus:border-cyber-primary" required>
                        </div>

                        <!-- Release Date -->
                        <div>
                            <label for="release_date" class="block text-sm font-medium text-gray-400">Release Date</label>
                            <input type="date" name="release_date" id="release_date" value="{{ old('release_date', $game->release_date) }}" class="mt-1 block w-full bg-cyber-bg border-cyber-secondary text-cyber-text rounded-md shadow-sm focus:ring-cyber-primary focus:border-cyber-primary" required>
                        </div>

                        <!-- Cover Image URL -->
                        <div class="col-span-2">
                            <label for="cover_image" class="block text-sm font-medium text-gray-400">Cover Image URL</label>
                            <input type="url" name="cover_image" id="cover_image" value="{{ old('cover_image', $game->cover_image) }}" class="mt-1 block w-full bg-cyber-bg border-cyber-secondary text-cyber-text rounded-md shadow-sm focus:ring-cyber-primary focus:border-cyber-primary" required>
                        </div>

                        <!-- Description -->
                        <div class="col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-400">Description</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full bg-cyber-bg border-cyber-secondary text-cyber-text rounded-md shadow-sm focus:ring-cyber-primary focus:border-cyber-primary" required>{{ old('description', $game->description) }}</textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('admin.games.index') }}" class="text-gray-400 hover:text-white mr-4">Cancel</a>
                        <button type="submit" class="bg-cyber-primary text-white px-4 py-2 rounded shadow hover:bg-cyber-secondary transition">
                            Update Game
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
