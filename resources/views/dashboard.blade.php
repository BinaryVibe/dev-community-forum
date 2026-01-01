<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Community Forum') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Create New Post
                </a>
            </div>

            @foreach ($posts as $post)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-bold mb-2">
                            <a href="{{ route('posts.show', $post) }}" class="hover:underline text-blue-600">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p class="text-gray-500 text-sm mb-2">
                            Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
                        </p>
                        <p>{{ Str::limit($post->body, 150) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>