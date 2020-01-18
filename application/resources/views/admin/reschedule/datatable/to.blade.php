<b>Tanggal : </b> {{ \Carbon\Carbon::parse($reschedule['to_date'])->format('d F Y') }}<br>
<b>Jadwal Kelas : </b> {{ $reschedule['to_class_schedule']['class_info'] }}
