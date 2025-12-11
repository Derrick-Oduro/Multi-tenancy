<input type="checkbox" id="editPostModal-{{ $post->id }}" class="hidden peer" />
<label for="editPostModal-{{ $post->id }}"
       class="fixed inset-0 bg-black/50 opacity-0 pointer-events-none peer-checked:opacity-100 peer-checked:pointer-events-auto transition"></label>
    <div class="fixed inset-0 flex items-center justify-center
            opacity-0 pointer-events-none transition-all
            peer-checked:opacity-100 peer-checked:pointer-events-auto">
    <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-xl">
        <h2 class="text-xl font-bold mb-4">Edit Post</h2>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <input name="title" value="{{ $post->title }}" class="w-full border p-2 rounded mb-4" placeholder="Title">
            {{-- select category --}}
            <select name="category_id" class="w-full border p-2 rounded mb-4">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <input type="file" name="image" class="w-full border p-2 rounded mb-4" />
            <textarea name="body" class="w-full border p-2 rounded mb-4" placeholder="Content">{{ $post->body }}</textarea>

            <div class="flex justify-end gap-2">
                <label for="editPostModal-{{ $post->id }}" class="px-4 py-2 border rounded cursor-pointer">
                    Close
                </label>

                <button class="px-4 py-2 bg-slate-800 text-white rounded">
                    Update
                </button>
            </div>

        </form>
