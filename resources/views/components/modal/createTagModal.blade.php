<input type="checkbox" id="createTagModal" class="peer hidden" />
<label for="createTagModal"
    class="fixed inset-0 bg-black/50 opacity-0 pointer-events-none peer-checked:opacity-100 peer-checked:pointer-events-auto transition"></label>
    <div class="fixed inset-0 flex items-center justify-center
            opacity-0 pointer-events-none transition-all
            peer-checked:opacity-100 peer-checked:pointer-events-auto">
    <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-xl">
        <h2 class="text-xl font-bold mb-4">Create Tag</h2>
        <form hx-post="{{ route('tags.store') }}" hx-target="#tags-table" hx-swap="innerHTML" hx-on="htmx:afterRequest: document.getElementById('createTagModal').checked = false" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('name') border-red-500 @enderror" >
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('slug') border-red-500 @enderror" >
                @error('slug')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end gap-2">
                <label for="createTagModal" class="px-4 py-2 border rounded cursor-pointer">
                    Close
                </label>
                <button
                    type="submit"
                    class="px-4 py-2 bg-black text-white rounded hover:bg-gray-700">
                    Create Tag
                </button>
            </div>
        </form>
    </div>
</div>
{{-- @if ($errors->any())
<script>
    document.getElementById('createTagModal').checked = true;
</script>
@endif --}}
@if(session('success'))
<div id="successToast"
     class="fixed top-4 center bg-green-600 text-white px-4 py-2 rounded shadow-lg">
    {{ session('success') }}
</div>
<script>
    setTimeout(() => {
        const toast = document.getElementById('successToast');
        if (toast) {
            toast.remove();
        }
    }, 3000);
</script>
@endif
