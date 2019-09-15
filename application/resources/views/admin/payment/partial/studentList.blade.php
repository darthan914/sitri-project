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
            <td>{{ $student->name }}</td>
            <td>
                @if($student->isReschedule($date))
                    <input type="hidden" name="status[{{ $student->id }}]" value="RESCHEDULE"> RESCHEDULE
                @else
                    <label class="radio-inline"><input type="radio" name="status[{{ $student->id }}]" value="PRESENT">
                        Present</label>
                    <label class="radio-inline"><input type="radio" name="status[{{ $student->id }}]" value="ABSENCE"
                                                       checked>
                        Payment</label>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
