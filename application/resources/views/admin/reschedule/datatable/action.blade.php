<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Action <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        <li>
            <a href="{{ route('admin.reschedule.edit', $reschedule['id']) }}">Edit</a>
        </li>
        <li>
            <a href="#" class="alert-modal" data-toggle="modal" data-target="#alert-modal"
               data-route="{{ route('admin.reschedule.delete', $reschedule['id']) }}"
               data-title="Delete reschedule?"
            >Delete</a>
        </li>
    </ul>
</div>
