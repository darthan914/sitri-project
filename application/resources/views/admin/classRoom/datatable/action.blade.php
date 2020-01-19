<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Action <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        <li>
            <a href="{{ route('admin.classRoom.edit', $classRoom['id']) }}">Edit</a>
        </li>
        <li>
            <a href="#" class="sweet-alert-active" data-toggle="modal" data-target="#active-modal"
               data-route="{{ route('admin.classRoom.active', $classRoom['id']) }}"
               data-active="{{ $classRoom['active'] ? '0' : '1' }}"
               data-title="{{ $classRoom['active'] ? 'Inactive' : 'Active' }} classRoom {{ $classRoom['name'] }}?"
            >Set {{ $classRoom['active'] ? 'Inactive' : 'Active' }}</a>
        </li>
        <li>
            <a href="#" class="sweet-alert-delete" data-toggle="modal" data-target="#alert-modal"
               data-route="{{ route('admin.classRoom.delete', $classRoom['id']) }}"
               data-title="Delete classRoom {{ $classRoom['name'] }}?"
            >Delete</a>
        </li>
    </ul>
</div>
