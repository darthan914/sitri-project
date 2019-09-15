<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Action <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        {{--@if(Auth::user()->can('update-user'))--}}
        <li>
            <a href="{{ route('admin.payment.edit', $index) }}">Edit</a>
        </li>
        {{--@endif--}}
        {{--@if(Auth::user()->can('delete-user'))--}}
        <li>
            <a href="#" class="alert-modal" data-toggle="modal" data-target="#alert-modal"
               data-route="{{ route('admin.payment.delete', $index) }}"
               data-title="Delete payment {{ $index->name }}?"
            >Delete</a>
        </li>
        <li>
            <a href="#" class="alertActive-modal" data-toggle="modal" data-target="#alertActive-modal"
               data-route="{{ route('admin.payment.paid', $index) }}"
               data-active="{{ $index->date_paid ? '0' : '1' }}"
               data-title="Set {{ $index->date_paid ? 'Unpaid' : 'Paid' }} {{ $index->no_payment }}?"
            >Set {{ $index->date_paid ? 'Unpaid' : 'Paid' }}</a>
        </li>
        {{--@endif--}}
    </ul>
</div>
