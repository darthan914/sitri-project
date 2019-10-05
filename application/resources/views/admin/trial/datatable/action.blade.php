<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Action <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        {{--@if(Auth::user()->can('update-trial'))--}}
        <li>
            <a href="{{ route('admin.trial.edit', $index) }}">Edit</a>
        </li>
        {{--@endif--}}
        {{--@if(Auth::user()->can('delete-trial'))--}}
        <li>
            <a href="#" class="alert-modal" data-toggle="modal" data-target="#alert-modal"
               data-route="{{ route('admin.trial.delete', $index) }}"
               data-title="Delete trial {{ $index->name }}?"
            >Delete</a>
        </li>
        {{--@endif--}}
    </ul>
</div>
