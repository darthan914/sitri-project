<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Action <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        <li>
            <a href="{{ route('admin.classStudent.edit', $classStudent['id']) }}">Edit</a>
        </li>
        <li>
            <a href="#" class="sweet-alert-delete"
               data-route="{{ route('admin.classStudent.delete', $classStudent['id']) }}"
               data-title="Delete Class Student?"
            >Delete</a>
        </li>
    </ul>
</div>
