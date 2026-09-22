<tr>
    <td class="text-center">{{ $rowNumber }}</td>
    <td>
        <strong>{{ $category->name }}</strong>
        <br>
        <small class="text-muted">{{ $category->slug }}</small>
    </td>
    <td>{{ $category->description ?: 'No description' }}</td>
    <td>
        <span class="badge badge-info">{{ $category->projects_count }} Projects</span>
    </td>
    <td>
        <form action="{{ route('admin.project-categories.toggle-status', $category) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-sm {{ $category->is_active ? 'btn-success' : 'btn-danger' }}">
                {{ $category->is_active ? 'Active' : 'Inactive' }}
            </button>
        </form>
    </td>
    <td>{{ $category->created_at->format('M d, Y') }}</td>
    <td>
        <div class="btn-group" role="group">
            <a href="{{ route('admin.project-categories.show', $category) }}" class="btn btn-sm btn-info">
                <i class="fas fa-eye"></i>
            </a>
            <a href="{{ route('admin.project-categories.edit', $category) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i>
            </a>
            @if($category->projects_count < 1)
                <form action="{{ route('admin.project-categories.destroy', $category) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this project category?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            @else
                <button type="button" class="btn btn-sm btn-secondary" disabled title="Linked with projects">
                    <i class="fas fa-trash"></i>
                </button>
            @endif
        </div>
    </td>
</tr>
