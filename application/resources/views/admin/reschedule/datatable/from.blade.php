<b>Tanggal : </b> {{ \Carbon\Carbon::parse($reschedule['from_date'])->format('d F Y') }}<br>
<b>Jadwal Kelas : </b> {{ $reschedule['from_class_schedule']['class_info'] }}
