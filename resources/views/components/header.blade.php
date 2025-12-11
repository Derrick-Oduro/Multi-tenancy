<header class="">
    <nav class="bg-white shadow mb-6">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex-1">
            </div>

            <div class="flex-1 text-center">
                <a href="/" class="text-xl font-bold text-gray-800">News Feed</a>
            </div>

            <div class="flex-1 flex justify-end">
                <!-- SUBSCRIBE BUTTON -->
                <label for="subscribeModal"
                    class="cursor-pointer bg-black text-white px-3 py-1 rounded hover:bg-gray-800 text-sm">
                    Subscribe
                </label>
                <x-modal.subscribeModal></x-modal.subscribeModal>
            </div>
        </div>
    </nav>
    @if(!request()->is('create'))
    <div class="bg-white border-b">
        <div class="container mx-auto px-1 py-1">
            <div class="flex justify-center space-x-4">
                <a href="/" class="text-xs text-gray-700 hover:text-black font-medium pb-1 border-b-2 transition-colors {{ request()->is('/') ? 'border-red-500 text-black' : 'border-transparent' }}">
                    News
                </a>
                @php
                    $categories = \App\Models\Category::all();
                @endphp

                @foreach($categories as $category)
                    <a href="{{ route('posts.byCategory', ['category' => $category]) }}" class="text-xs text-gray-700 hover:text-black font-medium pb-1 border-b-2 transition-colors
                        {{ request()->is('posts/category/' . $category->id) ? 'border-red-500 text-black' : 'border-transparent' }}
                        ">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</header>
