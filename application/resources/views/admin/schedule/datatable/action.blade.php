<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Action <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        <li>
            <a href="{{ route('admin.schedule.edit', $schedule['id']) }}">Edit</a>
        </li>
        <li>
            <a href="#" class="sweet-alert-active" data-toggle="modal" data-target="#active-modal"
               data-route="{{ route('admin.schedule.active', $schedule['id']) }}"
               data-active="{{ $schedule['active'] ? '0' : '1' }}"
               data-title="{{ $schedule['active'] ? 'Inactive' : 'Active' }} schedule?"
            >Set {{ $schedule['active'] ? 'Inactive' : 'Active' }}</a>
        </li>
        <li>
            <a href="#" class="sweet-alert-delete" data-toggle="modal" data-target="#alert-modal"
               data-route="{{ route('admin.schedule.delete', $schedule['id']) }}"
               data-title="Delete schedule?"
            >Delete</a>
        </li>
    </ul>
</div>
