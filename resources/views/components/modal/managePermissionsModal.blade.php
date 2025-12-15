<div>
    <input type="checkbox" id="managePermissionsModal-{{ $role->id }}" class="modal-toggle-{{ $role->id }} hidden" />

    <label for="managePermissionsModal-{{ $role->id }}"
           class="modal-backdrop-{{ $role->id }} fixed inset-0 bg-black/50 hidden z-40">
    </label>

    <div class="modal-content-{{ $role->id }} fixed inset-0 flex items-center justify-center hidden z-50">

        <div class="bg-white p-6 rounded-lg w-full max-w-4xl shadow-xl max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">

            <h3 class="text-xl font-bold mb-6">Manage Permissions for "{{ $role->name }}" Role</h3>

            <form action="{{ route('permissions.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                @php
                    $groupedPermissions = $allPermissions->groupBy(function($permission) {
                        // Extract category from permission name (e.g., "create posts" -> "posts")
                        $parts = explode(' ', $permission->name);
                        return count($parts) > 1 ? $parts[1] : 'general';
                    });
                @endphp

                @foreach($groupedPermissions as $category => $permissions)
                <div class="mb-6 border rounded-lg p-4 bg-gray-50">
                    <h4 class="font-semibold text-lg mb-4 capitalize">{{ $category }}</h4>

                    <div class="space-y-3">
                        @foreach($permissions as $permission)
                        <label class="flex items-center justify-between p-3 bg-white rounded border hover:bg-gray-50 cursor-pointer">
                            <span class="font-medium">{{ $permission->name }}</span>
                            <div class="relative inline-block w-12 h-6 transition duration-200 ease-linear">
                                <input
                                    type="checkbox"
                                    name="permissions[]"
                                    value="{{ $permission->id }}"
                                    {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}
                                    class="toggle-checkbox opacity-0 w-0 h-0 peer"
                                />
                                <span class="toggle-slider absolute cursor-pointer inset-0 bg-gray-300 rounded-full transition peer-checked:bg-blue-600">
                                    <span class="toggle-dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition peer-checked:translate-x-6"></span>
                                </span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach

                <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
                    <label for="managePermissionsModal-{{ $role->id }}" class="px-4 py-2 border rounded cursor-pointer hover:bg-gray-100">
                        Cancel
                    </label>
                    <button type="submit" class="px-6 py-2 bg-sky-600 text-white rounded hover:bg-sky-700">
                        Update Permissions
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.toggle-checkbox:checked ~ .toggle-slider {
    background-color: #25a6ebff;
}

.toggle-checkbox:checked ~ .toggle-slider .toggle-dot {
    transform: translateX(1.5rem);
}
</style>

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
