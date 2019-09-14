<b>Date : </b> {{ \Carbon\Carbon::parse($reschedule->from_date)->format('d F Y') }}<br>
<b>Class Schedule : </b> {{ $reschedule->fromClassSchedule->getClassInfo() }}
