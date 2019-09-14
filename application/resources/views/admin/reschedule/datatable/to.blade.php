<b>Date : </b> {{ \Carbon\Carbon::parse($reschedule->todate)->format('d F Y') }}<br>
<b>Class Schedule : </b> {{ $reschedule->toClassSchedule->getClassInfo() }}
