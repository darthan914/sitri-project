<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Action <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        <li>
            <a href="{{ route('admin.classSchedule.edit', $classSchedule['id']) }}">Edit</a>
        </li>
        <li>
            <a href="#" class="sweet-alert-delete" data-toggle="modal" data-target="#alert-modal"
               data-route="{{ route('admin.classSchedule.delete', $classSchedule['id']) }}"
               data-title="Delete Class Schedule?"
            >Delete</a>
        </li>
        <li>
            <a href="#" class="sweet-alert-active"
               data-route="{{ route('admin.classSchedule.active', $classSchedule['id']) }}"
               data-active="{{ $classSchedule['active'] ? '0' : '1' }}"
               data-title="{{ $classSchedule['active'] ? 'Inactive' : 'Active' }} class?"
            >Set {{ $classSchedule['active'] ? 'Inactive' : 'Active' }}</a>
        </li>
        <li>
            <a href="#" class="sweet-alert-active"
               data-route="{{ route('admin.classSchedule.trial', $classSchedule['id']) }}"
               data-active="{{ $classSchedule['is_trial'] ? '0' : '1' }}"
               data-title="Set {{ $classSchedule['is_trial'] ? 'not' : '' }} trial?"
            >Set {{ $classSchedule['is_trial'] ? 'not' : '' }} trial</a>
        </li>
    </ul>
</div>
