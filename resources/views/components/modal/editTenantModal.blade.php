<input type="checkbox" id="editTenantModal-{{ $tenant->id }}" class="peer hidden" />
<label for="editTenantModal-{{ $tenant->id }}"
       class="fixed inset-0 bg-black/50 opacity-0 pointer-events-none peer-checked:opacity-100 peer-checked:pointer-events-auto transition"></label>
    <div class="fixed inset-0 flex items-center justify-center
            opacity-0 pointer-events-none transition-all
            peer-checked:opacity-100 peer-checked:pointer-events-auto">
    <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-xl">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Edit Tenant</h2>
        <form action="{{ route('tenants.update', $tenant->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">@csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ $tenant->name }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ $tenant->slug }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
            <div>
                <label for="domain" class="block text-sm font-medium text-gray-700">Domain</label>
                <input type="text" name="domain" id="domain" value="{{ $tenant->domain }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
            <div class="flex justify-end gap-2">
                <label for="editTenantModal-{{ $tenant->id }}" class="px-4 py-2 border rounded cursor-pointer">
                    Close
                </label>

                <button
                    type="submit"
                    class="px-4 py-2 bg-sky-600 text-white rounded hover:bg-sky-700">
                    Update Tenant
                </button>
            </div>
        </form>
    </div>
</div>
