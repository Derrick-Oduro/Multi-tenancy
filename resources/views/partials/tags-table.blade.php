@forelse($tags as $tag)
<tr class="border-t" id="tag-{{ $tag->id }}">
    <td class="py-1 px-3 border-b text-sm text-slate-700 text-center">{{ $tag->id }}</td>
    <td class="py-1 px-3 border-b text-sm text-slate-700 text-center">{{ $tag->name }}</td>
    <td class="py-1 px-3 border-b text-sm text-slate-700 text-center">{{ $tag->slug ?? 'N/A' }}</td>
    <td class="py-1 px-3 border-b">
        <div class="flex justify-end space-x-2">

            @can('edit tags')
            <label for="editTagModal-{{ $tag->id }}"
                class="px-2 py-1 text-sm text-green-500 hover:underline">
                Edit
            </label>
            <x-modal.editTagModal :tag="$tag" />
            @endcan

            @can('delete tags')
            <button
                hx-delete="{{ route('tags.destroy', $tag->id) }}"
                hx-target="#tag-{{ $tag->id }}"
                hx-swap="outerHTML swap:1s"
                hx-confirm="Delete this tag?"
                class="px-2 py-1 text-sm text-orange-500 hover:underline">
                Delete
            </button>
            @endcan

        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="4" class="py-3 text-center text-slate-500">
        No tags available.
    </td>
</tr>
@endforelse
