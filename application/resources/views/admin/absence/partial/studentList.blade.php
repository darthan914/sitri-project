<table class="table table-bordered table-hover table-striped">
    <thead>
    <tr>
        <th>Student</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td>{{ $student['name'] }}</td>
            <td>
                @if($student['is_reschedule'])
                    <input type="hidden" name="status[{{ $student['id'] }}]" value="{{ \App\Sitri\Models\Admin\AbsenceDetail::STATUS_RESCHEDULE }}"> RESCHEDULE
                @else
                    <label class="radio-inline"><input type="radio" name="status[{{ $student['id'] }}]" value="{{ \App\Sitri\Models\Admin\AbsenceDetail::STATUS_PRESENT}}">
                        Present</label>
                    <label class="radio-inline"><input type="radio" name="status[{{ $student['id'] }}]" value="{{ \App\Sitri\Models\Admin\AbsenceDetail::STATUS_ABSENCE }}"
                                                       checked>
                        Absence</label>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
