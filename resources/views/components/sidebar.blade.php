<aside class="w-1/5 bg-white min-h-screen p-4">
        <nav class="space-y-4">
            <a href="{{ route('admin') }}"class="{{ request()->is('admin') ? 'bg-gray-200' : 'bg-white' }} block px-4 py-2 rounded hover:bg-gray-300">Dashboard</a>
            <a href="{{ route('posts.admin') }}"class="{{ request()->is('admin/posts') ? 'bg-gray-200' : 'bg-white' }} block px-4 py-2 rounded hover:bg-gray-300">Posts</a>
            <a href="{{ route('categories.index') }}"class="{{ request()->is('categories') ? 'bg-gray-200' : 'bg-white' }} block px-4 py-2 rounded hover:bg-gray-300">Categories</a>
            <a href="{{ route('tags.index') }}"class="{{ request()->is('tags') ? 'bg-gray-200' : 'bg-white' }} block px-4 py-2 rounded hover:bg-gray-300">Tags</a>
            <a href="{{ route('subscribers.index') }}"class="{{ request()->is('subscribers') ? 'bg-gray-200' : 'bg-white' }} block px-4 py-2 rounded hover:bg-gray-300">Subscribers</a>
            <a href="{{ route('admin.roles') }}"class="{{ request()->is('roles') ? 'bg-gray-200' : 'bg-white' }} block px-4 py-2 rounded hover:bg-gray-300">Asign Roles</a>
        </nav>
</aside>
