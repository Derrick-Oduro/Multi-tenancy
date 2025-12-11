<input type="checkbox" id="createCategoryModal" class="hidden peer" />

<label for="createCategoryModal"
       class="fixed inset-0 bg-black/50 opacity-0 pointer-events-none
              peer-checked:opacity-100 peer-checked:pointer-events-auto transition">
</label>

<div class="fixed inset-0 flex items-center justify-center
            opacity-0 pointer-events-none transition-all
            peer-checked:opacity-100 peer-checked:pointer-events-auto">

    <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-xl">

        <h2 class="text-xl font-bold mb-4">Create Category</h2>

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>

                <input type="text" name="name" id="name" class="mt-1 block w-full border p-2 rounded-md shadow-sm @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}"
                    placeholder="Category name">

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>

                <input type="text" name="slug" id="slug" class="mt-1 block w-full border p-2 rounded-md shadow-sm @error('slug') border-red-500 @enderror"
                    value="{{ old('slug') }}"
                    placeholder="Slug">

                @error('slug')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-2 mt-4">
                <label for="createCategoryModal"
                       class="px-4 py-2 border rounded cursor-pointer hover:bg-gray-100">
                    Close
                </label>

                <button type="submit"
                        class="px-4 py-2 bg-black text-white rounded hover:bg-gray-700">
                    Create Category
                </button>
            </div>

        </form>
    </div>
</div>
@if ($errors->any())
<script>
    document.getElementById('createCategoryModal').checked = true;
</script>
@endif

@if(session('success'))
<div id="successToast"
     class="fixed top-4 item-center bg-green-600 text-white px-4 py-2 rounded shadow-lg">
    {{ session('success') }}
</div>

<script>
    setTimeout(() => {
        const el = document.getElementById('successToast');
        if (el) {
            el.style.transition = "opacity 0.7s";
            el.style.opacity = "0";
        }
    }, 2000);
</script>
@endif
