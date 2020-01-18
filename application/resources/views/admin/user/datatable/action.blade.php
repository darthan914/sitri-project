<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Action <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        <li>
            <a href="{{ route('admin.user.edit', $user['id']) }}">Edit</a>
        </li>
        <li>
            <a href="#" class="sweet-alert-active"
               data-route="{{ route('admin.user.active', $user['id']) }}"
               data-active="{{ $user['active'] ? '0' : '1' }}"
               data-title="{{ $user['active'] ? 'Inactive' : 'Active' }} user {{ $user['name'] }}?"
            >Set {{ $user['active'] ? 'Inactive' : 'Active' }}</a>
        </li>
        <li>
            <a href="#" class="sweet-alert-delete"
               data-route="{{ route('admin.user.delete', $user['id']) }}"
               data-title="Delete user {{ $user['name'] }}?"
            >Delete</a>
        </li>
    </ul>
</div>
