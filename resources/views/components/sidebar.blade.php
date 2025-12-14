<aside class="w-1/5 bg-slate-900 min-h-screen p-4">
        <nav class="space-y-4">
            @role('admin|author|editor|guest')
            <a href="{{ route('admin') }}"class="{{ request()->is('admin') ? 'bg-slate-800' : 'bg-slate-900' }} block px-4 py-2 rounded hover:bg-slate-600 text-white">Dashboard</a>
            <a href="{{ route('posts.admin') }}"class="{{ request()->is('admin/posts') ? 'bg-slate-800' : 'bg-slate-900' }} block px-4 py-2 rounded hover:bg-slate-600 text-white">Posts</a>
            <a href="{{ route('categories.index') }}"class="{{ request()->is('categories') ? 'bg-slate-800' : 'bg-slate-900' }} block px-4 py-2 rounded hover:bg-slate-600 text-white">Categories</a>
            <a href="{{ route('tags.index') }}"class="{{ request()->is('tags') ? 'bg-slate-800' : 'bg-slate-900' }} block px-4 py-2 rounded hover:bg-slate-600 text-white">Tags</a>
            <a href="{{ route('subscribers.index') }}"class="{{ request()->is('subscribers') ? 'bg-slate-800' : 'bg-slate-900' }} block px-4 py-2 rounded hover:bg-slate-600 text-white">Subscribers</a>
            <a href="{{ route('admin.roles') }}"class="{{ request()->is('roles') ? 'bg-slate-800' : 'bg-slate-900' }} block px-4 py-2 rounded hover:bg-slate-600 text-white">Asign Roles</a>
            @endrole
            @role('super-admin|admin')
            <a href="{{ route('users.index') }}"class="{{ request()->is('users') ? 'bg-slate-800' : 'bg-slate-900' }} block px-4 py-2 rounded hover:bg-slate-600 text-white">Users</a>
            @endrole
            @role('super-admin')
            <a href="{{ route('permissions.index') }}"class="{{ request()->is('permissions') ? 'bg-slate-800' : 'bg-slate-900' }} block px-4 py-2 rounded hover:bg-slate-600 text-white">Permissions</a>
            <a href="{{ route('tenants.index') }}"class="{{ request()->is('tenants') ? 'bg-slate-800' : 'bg-slate-900' }} block px-4 py-2 rounded hover:bg-slate-600 text-white">Tenants</a>
            @endrole

        </nav>
</aside>
