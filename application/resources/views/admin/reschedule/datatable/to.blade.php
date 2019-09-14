<b>Date : </b> {{ \Carbon\Carbon::parse($reschedule->to_date)->format('d F Y') }}<br>
<b>Class Schedule : </b> {{ $reschedule->toClassSchedule->getClassInfo() }}
