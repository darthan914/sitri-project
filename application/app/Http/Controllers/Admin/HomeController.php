<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sitri\Repositories\ClassRoom\ClassRoomRepositoryInterface;
use App\Sitri\Repositories\ClassSchedule\ClassScheduleRepositoryInterface;
use App\Sitri\Repositories\ClassStudent\ClassStudentRepositoryInterface;
use App\Sitri\Repositories\Reschedule\RescheduleRepositoryInterface;
use App\Sitri\Repositories\Schedule\ScheduleRepositoryInterface;
use App\Sitri\Repositories\Student\StudentRepositoryInterface;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * @var ScheduleRepositoryInterface
     */
    private $scheduleRepository;
    /**
     * @var StudentRepositoryInterface
     */
    private $studentRepository;
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
     * HomeController constructor.
     *
     * @param ScheduleRepositoryInterface      $scheduleRepository
     * @param StudentRepositoryInterface       $studentRepository
     * @param RescheduleRepositoryInterface    $rescheduleRepository
     * @param ClassScheduleRepositoryInterface $classScheduleRepository
     * @param ClassRoomRepositoryInterface     $classRoomRepository
     * @param ClassStudentRepositoryInterface  $classStudentRepository
     */
    public function __construct(
        ScheduleRepositoryInterface $scheduleRepository,
        StudentRepositoryInterface $studentRepository,
        RescheduleRepositoryInterface $rescheduleRepository,
        ClassScheduleRepositoryInterface $classScheduleRepository,
        ClassRoomRepositoryInterface $classRoomRepository,
        ClassStudentRepositoryInterface $classStudentRepository
    ) {
        $this->scheduleRepository = $scheduleRepository;
        $this->studentRepository = $studentRepository;
        $this->rescheduleRepository = $rescheduleRepository;
        $this->classScheduleRepository = $classScheduleRepository;
        $this->classRoomRepository = $classRoomRepository;
        $this->classStudentRepository = $classStudentRepository;
    }

    public function index()
    {
        $activeDays = $this->scheduleRepository->getActiveDay();

        $startWeek = Carbon::now()->startOfWeek()->subDay(2);
        $weekDates = [];
        foreach (range(0, 6) as $week) {
            $weekDates[$week] = $startWeek->addDay()->toDateString();
        }

        $classRooms = $this->classRoomRepository->getActive();
        $classSchedules = $this->classScheduleRepository->getActive();

        $tableSchedules = [];
        foreach ($activeDays as $activeDay) {
            $schedules = $this->scheduleRepository->getScheduleByDay($activeDay);

            $dataSchedules = [];
            foreach ($schedules as $schedule) {

                $dataClassRooms = [];
                foreach ($classRooms as $classRoom) {
                    foreach ($classSchedules as $key => $classSchedule) {
                        if ($classSchedule['class_room_id'] === $classRoom['id'] && $classSchedule['schedule_id'] === $schedule['id']) {

                            $classStudents = $this->classStudentRepository->getStudentByClassScheduleId($classSchedule['id']);

                            $dataStudents = [];
                            foreach ($classStudents as $classStudent) {
                                $dataStudents[] = [
                                    'student_id'    => $classStudent['student_id'],
                                    'student_name'  => $classStudent['student']['surname'] ?? $classStudent['student']['name'],
                                    'teacher_name'  => $classStudent['teacher_name'],
                                    'on_reschedule' => $this->rescheduleRepository->isStudentOnReschedule($classStudent['student_id'],
                                        $weekDates[$activeDay], $classSchedule['id'])
                                ];
                            }

                            $studentReschedules = $this->rescheduleRepository->getStudentRescheduleToByDateAndClassSchedule($weekDates[$activeDay],
                                $classSchedule['id']);
                            $dataStudentReschedules = [];
                            foreach ($studentReschedules as $studentReschedule) {
                                $dataStudentReschedules[] = [
                                    'student_id'   => $studentReschedule['student_id'],
                                    'student_name' => $studentReschedule['student']['surname'] ?? $studentReschedule['student']['name'],
                                    'teacher_name' => $this->classStudentRepository->getFirstTeacherName($studentReschedule['student_id']),
                                ];
                            }

                            $dataClassRooms[] = [
                                'name'                => $classRoom['name'],
                                'class_schedule_id'   => $classSchedule['id'],
                                'students'            => $dataStudents,
                                'student_reschedules' => $dataStudentReschedules,
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

            $tableSchedules[] = [
                'day'       => $activeDay,
                'date'      => $weekDates[$activeDay],
                'schedules' => $dataSchedules
            ];
        }

        $studentNotOnSchedule = $this->studentRepository->getStudentsNotOnSchedule(['user']);
        $studentOnTrial = $this->studentRepository->getStudentsOnTrial(true, ['user']);

        return view('admin.home.index', compact('tableSchedules', 'studentNotOnSchedule', 'studentOnTrial'));
    }
}
