<input type="checkbox" id="createUserModal" class="peer hidden" />
<label for="createUserModal"
    class="fixed inset-0 bg-black/50 opacity-0 pointer-events-none peer-checked:opacity-100 peer-checked:pointer-events-auto transition"></label>
    <div class="fixed inset-0 flex items-center justify-center
            opacity-0 pointer-events-none transition-all
            peer-checked:opacity-100 peer-checked:pointer-events-auto">
    <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-xl">
        <h2 class="text-xl font-bold mb-4">Create User</h2>
        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('name') border-red-500 @enderror" >
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('email') border-red-500 @enderror" >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('password') border-red-500 @enderror" >
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            {{-- confirm password --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('password_confirmation') border-red-500 @enderror" >
                @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end gap-2">
                <label for="createUserModal" class="px-4 py-2 border rounded cursor-pointer">
                    Close
                </label>
                <button
                    type="submit"
                    class="px-4 py-2 bg-sky-600 text-white rounded hover:bg-gray-700">
                    Create User
                </button>
            </div>
        </form>
    </div>
</div>
@if ($errors->any())
<script>
    document.getElementById('createUserModal').checked = true;
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
