<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Action <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        <li>
            <a href="{{ route('admin.student.view', $student['id']) }}">View</a>
        </li>
        <li>
            <a href="{{ route('admin.student.edit', $student['id']) }}">Edit</a>
        </li>
        <li>
            <a href="#" class="sweet-alert-delete"
               data-route="{{ route('admin.student.delete', $student['id']) }}"
               data-title="Delete student {{ $student['name'] }}?"
            >Delete</a>
        </li>
    </ul>
</div>
