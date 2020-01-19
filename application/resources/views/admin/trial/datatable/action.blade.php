<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Action <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        <li>
            <a href="{{ route('admin.trial.edit', $student['id']) }}">Edit</a>
        </li>
        <li>
            <a href="#" class="sweet-alert-delete"
               data-route="{{ route('admin.trial.delete', $student['id']) }}"
               data-title="Delete trial {{ $student['name'] }}?"
            >Delete</a>
        </li>
        <li>
            <a href="{{ route('admin.student.edit', $student['id']) }}">Make Regular</a>
        </li>
    </ul>
</div>
