<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
            <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>
            <p class="text-gray-500 text-sm mb-6">By {{ $post->user->name }}</p>
            
            <div class="text-lg text-gray-800 leading-relaxed">
                {{ $post->body }}
            </div>

            <div class="mt-6 border-t pt-4">
                <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">
                    &larr; Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>