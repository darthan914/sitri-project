<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sitri\Repositories\Absence\AbsenceRepositoryInterface;
use App\Sitri\Repositories\ClassRoom\ClassRoomRepositoryInterface;
use App\Sitri\Repositories\ClassSchedule\ClassScheduleRepositoryInterface;
use App\Sitri\Repositories\ClassStudent\ClassStudentRepositoryInterface;
use App\Sitri\Repositories\Payment\PaymentRepositoryInterface;
use App\Sitri\Repositories\Reschedule\RescheduleRepositoryInterface;
use App\Sitri\Repositories\Schedule\ScheduleRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @var ScheduleRepositoryInterface
     */
    private $scheduleRepository;
    /**
     * @var RescheduleRepositoryInterface
     */
    private $rescheduleRepository;
    /**
     * @var ClassScheduleRepositoryInterface
     */
    private $classScheduleRepository;
    /**
     * @var ClassRoomRepositoryInterface
     */
    private $classRoomRepository;
    /**
     * @var ClassStudentRepositoryInterface
     */
    private $classStudentRepository;
    /**
     * @var AbsenceRepositoryInterface
     */
    private $absenceRepository;
    /**
     * @var PaymentRepositoryInterface
     */
    private $paymentRepository;

    /**
     * HomeController constructor.
     *
     * @param ScheduleRepositoryInterface      $scheduleRepository
     * @param RescheduleRepositoryInterface    $rescheduleRepository
     * @param ClassScheduleRepositoryInterface $classScheduleRepository
     * @param ClassRoomRepositoryInterface     $classRoomRepository
     * @param ClassStudentRepositoryInterface  $classStudentRepository
     * @param AbsenceRepositoryInterface       $absenceRepository
     * @param PaymentRepositoryInterface       $paymentRepository
     */
    public function __construct(
        ScheduleRepositoryInterface $scheduleRepository,
        RescheduleRepositoryInterface $rescheduleRepository,
        ClassScheduleRepositoryInterface $classScheduleRepository,
        ClassRoomRepositoryInterface $classRoomRepository,
        ClassStudentRepositoryInterface $classStudentRepository,
        AbsenceRepositoryInterface $absenceRepository,
        PaymentRepositoryInterface $paymentRepository
    ) {
        $this->scheduleRepository = $scheduleRepository;
        $this->rescheduleRepository = $rescheduleRepository;
        $this->classScheduleRepository = $classScheduleRepository;
        $this->classRoomRepository = $classRoomRepository;
        $this->classStudentRepository = $classStudentRepository;
        $this->absenceRepository = $absenceRepository;
        $this->paymentRepository = $paymentRepository;
    }

    public function index(Request $request)
    {
        $carbon = Carbon::now();
        $thisYear = $request->get('f_year', $carbon->year);
        $thisMonth = $request->get('f_month', $carbon->month);

        $startWeek = Carbon::create($thisYear, $thisMonth)->startOfWeek()->subDay(2);

        $weekDates = [];
        foreach (range(0, 6) as $week) {
            $weekDates[$week] = $startWeek->addDay()->toDateString();
        }

        $activeDays = $this->scheduleRepository->getActiveDay();

        $headerTables = [];
        foreach ($activeDays as $day) {
            $countWeekOfDay = Carbon::create($thisYear, $thisMonth)->lastOfMonth($day)->weekOfMonth;

            $firstDay = Carbon::create($thisYear, $thisMonth)->firstOfMonth($day)->subWeek(1);
            $dataDates = [];
            foreach (range(1, $countWeekOfDay) as $dateOfWeek) {
                $dataDates[] = $firstDay->addWeek()->toDateString();
            }

            $headerTables[$day] = [
                'day'   => $day,
                'name'  => config('sitri.day')[$day],
                'dates' => $dataDates
            ];
        }

        $classRooms = $this->classRoomRepository->getActive();
        $classSchedules = $this->classScheduleRepository->getActive();

        $tableDashboards = [];
        foreach ($activeDays as $day) {
            $schedules = $this->scheduleRepository->getScheduleByDay($day);

            $dataSchedules = [];
            foreach ($schedules as $schedule) {

                $dataClassRooms = [];
                foreach ($classRooms as $classRoom) {
                    foreach ($classSchedules as $key => $classSchedule) {
                        if ($classSchedule['class_room_id'] == $classRoom['id'] && $classSchedule['schedule_id'] == $schedule['id']) {

                            $classStudents = $this->classStudentRepository->getStudentByClassScheduleId($classSchedule['id']);

                            $dataStudents = [];
                            foreach ($classStudents as $classStudent) {

                                $dataAbsences = [];
                                foreach ($headerTables[$day]['dates'] as $date) {
                                    $dataAbsences[$date] = $this->absenceRepository->getStatusStudentAbsence($classStudent['student_id'],
                                        $date);
                                }

                                $dataStudents[] = [
                                    'student_id'   => $classStudent['student_id'],
                                    'student_name' => $classStudent['student']['surname'] ?? $classStudent['student']['name'],
                                    'teacher_name' => $classStudent['teacher_name'],
                                    'absences'     => $dataAbsences,
                                    'paid'         => $this->paymentRepository->getStatusPaymentDate($classStudent['student_id'],
                                        $thisYear, $thisMonth)
                                ];
                            }

                            $dataClassRooms[] = [
                                'name'                => $classRoom['name'],
                                'class_schedule_id'   => $classSchedule['id'],
                                'students'            => $dataStudents,
                            ];

                            unset($classSchedules[$key]);
                            break;
                        }
                    }
                }

                $dataSchedules[] = [
                    'time'        => $schedule['start_time'] . ' - ' . $schedule['end_time'],
                    'class_rooms' => $dataClassRooms
                ];
            }

            $tableDashboards[$day] = [
                'schedules' => $dataSchedules
            ];
        }

        $startYear = 2019;

        return view('admin.dashboard.index', compact('headerTables', 'tableDashboards', 'startYear', 'request'));
    }
}
