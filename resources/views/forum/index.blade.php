<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-cyber-primary leading-tight">
                {{ $game->title }} - Forum
            </h2>
            <a href="{{ route('games.show', $game) }}" class="text-xs text-cyber-text hover:text-white">Back to Game</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Create Post -->
            <div class="bg-cyber-alt shadow sm:rounded-lg border border-cyber-secondary/30 p-6">
                <h3 class="text-lg font-medium text-cyber-text mb-4">Start a Discussion</h3>
                <form action="{{ route('forum.store', $game->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-400">Title</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full bg-cyber-bg border-cyber-secondary text-cyber-text rounded-md shadow-sm focus:ring-cyber-primary focus:border-cyber-primary" required>
                    </div>
                    <div class="mb-4">
                        <label for="body" class="block text-sm font-medium text-gray-400">Content</label>
                        <textarea name="body" id="body" rows="3" class="mt-1 block w-full bg-cyber-bg border-cyber-secondary text-cyber-text rounded-md shadow-sm focus:ring-cyber-primary focus:border-cyber-primary" required></textarea>
                    </div>
                    <button type="submit" class="bg-cyber-primary text-white px-4 py-2 rounded shadow hover:bg-cyber-secondary transition">
                        Post
                    </button>
                </form>
            </div>

            <!-- Posts List -->
            @forelse($posts as $post)
                <div class="bg-cyber-alt overflow-hidden shadow sm:rounded-lg border border-cyber-secondary/30">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <a href="{{ route('forum.show', [$game->id, $post->id]) }}" class="block text-xl font-bold text-cyber-primary hover:text-cyber-secondary hover:underline">
                                    {{ $post->title }}
                                </a>
                                <p class="text-sm text-gray-500 mt-1">
                                    Posted by <span class="text-gray-300">{{ $post->user->name }}</span> • {{ $post->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <span class="bg-cyber-secondary/10 text-cyber-secondary text-xs px-2 py-1 rounded border border-cyber-secondary/30">
                                {{ $post->comments()->count() }} Comments
                            </span>
                        </div>
                        <p class="text-gray-300 mt-4 line-clamp-2">{{ $post->body }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <p class="text-gray-500">No discussions yet. Be the first!</p>
                </div>
            @endforelse

            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
