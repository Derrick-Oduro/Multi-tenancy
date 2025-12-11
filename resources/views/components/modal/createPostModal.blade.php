<input type="checkbox" id="createPostModal" class="hidden peer" />

<label for="createPostModal"
       class="fixed inset-0 bg-black/50 opacity-0 pointer-events-none peer-checked:opacity-100 peer-checked:pointer-events-auto transition">
</label>

    <div class="fixed inset-0 flex items-center justify-center
            opacity-0 pointer-events-none transition-all
            peer-checked:opacity-100 peer-checked:pointer-events-auto">

    <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-xl">

        <h2 class="text-xl font-bold mb-4">Create Post</h2>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <input name="title" class="w-full border p-2 rounded mb-4 @error('title') border-red-500 @enderror" value="{{ old('title') }}" placeholder="Title">

            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            {{-- select category --}}
            <select name="category_id" class="w-full border p-2 rounded mb-4 @error('category_id') border-red-500 @enderror" >
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <input type="file" name="image" class="w-full border p-2 rounded mb-4 @error('image') border-red-500 @enderror" />
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <textarea name="body" class="w-full border p-2 rounded mb-4 @error('body') border-red-500 @enderror" placeholder="Content"></textarea>
            @error('body')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <div class="flex justify-end gap-2">
                <label for="createPostModal" class="px-4 py-2 border rounded cursor-pointer">
                    Close
                </label>

                <button class="px-4 py-2 bg-slate-800 text-white rounded">
                    Save
                </button>
            </div>

        </form>
    </div>
</div>
@if ($errors->any())
<script>
    document.getElementById('createPostModal').checked = true;
</script>
@endif

@if(session('success'))
<div id="successToast"
     class="fixed top-4 center bg-green-600 text-white px-4 py-2 rounded shadow-lg">
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
