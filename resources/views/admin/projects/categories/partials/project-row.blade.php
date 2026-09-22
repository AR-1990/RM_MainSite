<tr>
    <td>{{ $project->title }}</td>
    <td>{{ $project->project_type_text }}</td>
    <td>{{ $project->location ?: '-' }}</td>
    <td>{{ $project->is_active ? 'Active' : 'Inactive' }}</td>
    <td>
        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-primary">
            <i class="fas fa-edit"></i>
        </a>
    </td>
</tr>
