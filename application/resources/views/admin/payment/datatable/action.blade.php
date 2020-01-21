<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Action <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        <li>
            <a href="{{ route('admin.payment.edit', $payment['id']) }}">Edit</a>
        </li>
        <li>
            <a href="#" class="sweet-alert-delete"
               data-route="{{ route('admin.payment.delete', $payment['id']) }}"
               data-title="Delete payment {{ $payment['no_payment'] }}?"
            >Delete</a>
        </li>
        <li>
            <a href="#" class="sweet-alert-active"
               data-route="{{ route('admin.payment.paid', $payment['id']) }}"
               data-active="{{ $payment['date_paid'] ? '0' : '1' }}"
               data-title="Set {{ $payment['date_paid'] ? 'Unpaid' : 'Paid' }} {{ $payment['no_payment'] }}?"
            >Set {{ $payment['date_paid'] ? 'Unpaid' : 'Paid' }}</a>
        </li>
    </ul>
</div>
