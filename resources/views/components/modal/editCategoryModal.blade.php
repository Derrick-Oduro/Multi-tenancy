<input type="checkbox" id="editCategoryModal-{{ $category->id }}" class="hidden peer" />
<label for="editCategoryModal-{{ $category->id }}"
       class="fixed inset-0 bg-black/50 opacity-0 pointer-events-none peer-checked:opacity-100 peer-checked:pointer-events-auto transition"></label>
    <div class="fixed inset-0 flex items-center justify-center
            opacity-0 pointer-events-none transition-all
            peer-checked:opacity-100 peer-checked:pointer-events-auto">
    <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-xl">
        <h2 class="text-xl font-bold mb-4">Edit Category</h2>
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">@csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ $category->name }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ $category->slug }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
            <div class="flex justify-end gap-2">
                <label for="editCategoryModal-{{ $category->id }}" class="px-4 py-2 border rounded cursor-pointer">
                    Close
                </label>

                <button
                    type="submit"
                    class="px-4 py-2 bg-black text-white rounded hover:bg-gray-700">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</div>
