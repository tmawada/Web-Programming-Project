<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-cyber-primary leading-tight">
                {{ $post->title }}
            </h2>
            <a href="{{ route('forum.index', $game->id) }}" class="text-sm text-cyber-text hover:text-white">Back to Forum</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Original Post -->
            <div class="bg-cyber-alt shadow sm:rounded-lg border border-cyber-secondary/30 p-6">
                <div class="flex items-center mb-4">
                    <div class="h-10 w-10 rounded-full bg-cyber-secondary/20 flex items-center justify-center text-cyber-primary font-bold mr-3">
                        {{ substr($post->user->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="text-gray-200 font-medium">{{ $post->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                <div class="text-gray-300 prose prose-invert max-w-none">
                    {{ $post->body }}
                </div>
            </div>

            <!-- Comments -->
            <div class="space-y-4">
                <h3 class="text-lg font-medium text-cyber-text">Comments ({{ $post->comments->count() }})</h3>
                
                @foreach($post->comments as $comment)
                    <div class="bg-cyber-bg p-4 rounded border border-cyber-secondary/20">
                        <div class="flex items-center mb-2">
                            <span class="text-cyber-secondary font-bold mr-2">{{ $comment->user->name }}</span>
                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-300">{{ $comment->body }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Add Comment -->
            <div class="bg-cyber-alt shadow sm:rounded-lg border border-cyber-secondary/30 p-6">
                <h3 class="text-lg font-medium text-cyber-text mb-4">Leave a Comment</h3>
                <form action="{{ route('comments.store', $post->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <textarea name="body" rows="3" class="mt-1 block w-full bg-cyber-bg border-cyber-secondary text-cyber-text rounded-md shadow-sm focus:ring-cyber-primary focus:border-cyber-primary" required placeholder="Join the discussion..."></textarea>
                    </div>
                    <button type="submit" class="bg-cyber-primary text-white px-4 py-2 rounded shadow hover:bg-cyber-secondary transition">
                        Comment
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
