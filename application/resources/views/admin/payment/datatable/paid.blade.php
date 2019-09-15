@if(null !== $payment->date_paid)
    {{ \Carbon\Carbon::parse($payment->date_paid)->format('d F Y') }}<br>
    {{ $payment->note }}
@else
    PENDING
@endif
