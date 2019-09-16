<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Action <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        {{--@if(Auth::user()->can('update-user'))--}}
        <li>
            <a href="{{ route('admin.classSchedule.edit', $index) }}">Edit</a>
        </li>
        {{--@endif--}}
        {{--@if(Auth::user()->can('active-user'))--}}
        <li>
            <a href="#" class="active-modal" data-toggle="modal" data-target="#active-modal"
               data-route="{{ route('admin.classSchedule.active', $index) }}"
               data-active="{{ $index->active ? '0' : '1' }}"
               data-title="{{ $index->active ? 'Inactive' : 'Active' }} classSchedule {{ $index->name }}?"
            >Set {{ $index->active ? 'Inactive' : 'Active' }}</a>
        </li>
        {{--@endif--}}
        {{--@if(Auth::user()->can('delete-user'))--}}
        <li>
            <a href="#" class="alert-modal" data-toggle="modal" data-target="#alert-modal"
               data-route="{{ route('admin.classSchedule.delete', $index) }}"
               data-title="Delete classSchedule {{ $index->name }}?"
            >Delete</a>
        </li>
        {{--@endif--}}
    </ul>
</div>
