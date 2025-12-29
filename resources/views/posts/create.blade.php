<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Write a Post</h2>
            
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Title</label>
                    <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Content</label>
                    <textarea name="body" class="w-full border rounded px-3 py-2 h-40" required></textarea>
                </div>

                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Publish Post
                </button>
            </form>
        </div>
    </div>
</x-app-layout>