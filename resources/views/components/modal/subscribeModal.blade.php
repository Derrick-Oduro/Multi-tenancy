<input type="checkbox" id="subscribeModal" class="peer hidden" />

<!-- MODAL -->
<label for="subscribeModal"
    class="fixed inset-0 bg-black/50 opacity-0 pointer-events-none peer-checked:opacity-100 peer-checked:pointer-events-auto transition z-50"></label>
<div class="fixed inset-0 flex items-center justify-center
            opacity-0 pointer-events-none transition-all
            peer-checked:opacity-100 peer-checked:pointer-events-auto z-50">
    <div class="bg-white p-6 rounded-lg w-80 shadow-xl">
        <h2 class="text-lg font-semibold mb-3">Subscribe</h2>

        <form action="{{ route('subscribe.store') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <input type="email" name="email" placeholder="Enter email"
                       class="w-full border border-gray-300 rounded-md shadow-sm p-2 @error('email') border-red-500 @enderror" >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end gap-2">
                <label for="subscribeModal" class="px-4 py-2 border rounded cursor-pointer">
                    Close
                </label>
                <button type="submit"
                        class="px-4 py-2 bg-black text-white rounded hover:bg-gray-700">
                    Subscribe
                </button>
            </div>
        </form>
    </div>
</div>

@if ($errors->any())
<script>
    document.getElementById('subscribeModal').checked = true;
</script>
@endif

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
