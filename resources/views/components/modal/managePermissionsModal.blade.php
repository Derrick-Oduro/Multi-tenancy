<div>
    <input type="checkbox" id="managePermissionsModal-{{ $role->id }}" class="modal-toggle-{{ $role->id }} hidden" />

    <label for="managePermissionsModal-{{ $role->id }}"
           class="modal-backdrop-{{ $role->id }} fixed inset-0 bg-black/50 hidden z-40">
    </label>

    <div class="modal-content-{{ $role->id }} fixed inset-0 flex items-center justify-center hidden z-50">

        <div class="bg-white p-6 rounded-lg w-full max-w-3xl shadow-xl max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">

            <h3 class="text-xl font-bold mb-6">Manage Permissions for "{{ $role->name }}" Role</h3>

            {{-- Current Permissions --}}
            <div class="mb-6">
                <h4 class="font-semibold text-lg mb-3">Current Permissions:</h4>
                <div class="space-y-2 max-h-60 overflow-y-auto">
                    @forelse($role->permissions as $permission)
                    <div class="flex justify-between items-center bg-gray-50 p-3 rounded border">
                        <span class="font-medium">{{ $permission->name }}</span>
                        <form action="{{ route('permissions.detach', [$role->id, $permission->id]) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">
                                Remove
                            </button>
                        </form>
                    </div>
                    @empty
                    <p class="text-gray-500 text-center py-4">No permissions assigned to this role</p>
                    @endforelse
                </div>
            </div>

            <div class="border-t my-6"></div>

            {{-- Add Permission --}}
            <div class="mb-6">
                <h4 class="font-semibold text-lg mb-3">Add Permission:</h4>
                <form action="{{ route('permissions.attach', $role->id) }}" method="POST">
                    @csrf
                    <div class="flex gap-3">
                        <select name="permission_id" class="flex-1 border p-2 rounded" required>
                            <option value="">Select a permission to add</option>
                            @foreach($allPermissions as $permission)
                                @if(!$role->permissions->contains('id', $permission->id))
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Add
                        </button>
                    </div>
                </form>
            </div>

            <div class="flex justify-end">
                <label for="managePermissionsModal-{{ $role->id }}" class="px-4 py-2 border rounded cursor-pointer hover:bg-gray-100">
                    Close
                </label>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    const checkbox = document.getElementById('managePermissionsModal-{{ $role->id }}');
    const backdrop = document.querySelector('.modal-backdrop-{{ $role->id }}');
    const content = document.querySelector('.modal-content-{{ $role->id }}');

    checkbox.addEventListener('change', function() {
        if (this.checked) {
            backdrop.classList.remove('hidden');
            content.classList.remove('hidden');
        } else {
            backdrop.classList.add('hidden');
            content.classList.add('hidden');
        }
    });

    backdrop.addEventListener('click', function() {
        checkbox.checked = false;
        backdrop.classList.add('hidden');
        content.classList.add('hidden');
    });
})();
</script>
