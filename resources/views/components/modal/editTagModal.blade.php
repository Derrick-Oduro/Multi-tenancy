<input type="checkbox" id="editTagModal-{{ $tag->id }}" class="peer hidden" />
<label for="editTagModal-{{ $tag->id }}"
       class="fixed inset-0 opacity-0 pointer-events-none peer-checked:opacity-100 peer-checked:pointer-events-auto transition"></label>
    <div class="fixed inset-0 flex items-center justify-center
            opacity-0 pointer-events-none transition-all
            peer-checked:opacity-100 peer-checked:pointer-events-auto">
    <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-xl">
        <h2 class="text-xl font-bold mb-4">Edit Tag</h2>
        <form hx-put="{{ route('tags.update', $tag->id) }}" hx-target="#tags-table" hx-swap="innerHTML" class="space-y-4">@csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ $tag->name }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ $tag->slug }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
            <div class="flex justify-end gap-2">
                <label for="editTagModal-{{ $tag->id }}" class="px-4 py-2 border rounded cursor-pointer">
                    Close
                </label>

                <button
                    type="submit"
                    class="px-4 py-2 bg-black text-white rounded hover:bg-gray-700">
                    Update Tag
                </button>
            </div>
        </form>
    </div>
</div>
