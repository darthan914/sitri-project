<?php

return [
    'accesses' => [
        [
            'name' => 'User',
            'id'   => 'user',
            'data' => [
                ['name' => 'Full Access', 'value' => 'confirm', 'policy' => 'App\Policies\UserPolicy@full'],
                ['name' => 'List', 'value' => 'list', 'policy' => 'App\Policies\UserPolicy@list'],
                ['name' => 'Create', 'value' => 'create', 'policy' => 'App\Policies\UserPolicy@create'],
                ['name' => 'Update', 'value' => 'update', 'policy' => 'App\Policies\UserPolicy@update'],
                ['name' => 'Delete', 'value' => 'delete', 'policy' => 'App\Policies\UserPolicy@delete'],
            ]
        ],
        [
            'name' => 'Role',
            'id'   => 'role',
            'data' => [
                ['name' => 'List', 'value' => 'list', 'policy' => 'App\Policies\RolePolicy@list'],
                ['name' => 'Create', 'value' => 'create', 'policy' => 'App\Policies\RolePolicy@create'],
                ['name' => 'Update', 'value' => 'update', 'policy' => 'App\Policies\RolePolicy@update'],
                ['name' => 'Delete', 'value' => 'delete', 'policy' => 'App\Policies\RolePolicy@delete'],
            ]
        ],
        [
            'name' => 'Student',
            'id'   => 'student',
            'data' => [
                ['name' => 'List', 'value' => 'list', 'policy' => 'App\Policies\StudentPolicy@list'],
                ['name' => 'Create', 'value' => 'create', 'policy' => 'App\Policies\StudentPolicy@create'],
                ['name' => 'Update', 'value' => 'update', 'policy' => 'App\Policies\StudentPolicy@update'],
                ['name' => 'Delete', 'value' => 'delete', 'policy' => 'App\Policies\StudentPolicy@delete'],
            ]
        ],
        [
            'name' => 'Schedule',
            'id'   => 'schedule',
            'data' => [
                ['name' => 'List', 'value' => 'list', 'policy' => 'App\Policies\SchedulePolicy@list'],
                ['name' => 'Create', 'value' => 'create', 'policy' => 'App\Policies\SchedulePolicy@create'],
                ['name' => 'Update', 'value' => 'update', 'policy' => 'App\Policies\SchedulePolicy@update'],
                ['name' => 'Delete', 'value' => 'delete', 'policy' => 'App\Policies\SchedulePolicy@delete'],
            ]
        ],
        [
            'name' => 'ClassRoom',
            'id'   => 'classRoom',
            'data' => [
                ['name' => 'List', 'value' => 'list', 'policy' => 'App\Policies\ClassRoomPolicy@list'],
                ['name' => 'Create', 'value' => 'create', 'policy' => 'App\Policies\ClassRoomPolicy@create'],
                ['name' => 'Update', 'value' => 'update', 'policy' => 'App\Policies\ClassRoomPolicy@update'],
                ['name' => 'Delete', 'value' => 'delete', 'policy' => 'App\Policies\ClassRoomPolicy@delete'],
            ]
        ],
        [
            'name' => 'ClassSchedule',
            'id'   => 'classSchedule',
            'data' => [
                ['name' => 'List', 'value' => 'list', 'policy' => 'App\Policies\ClassSchedulePolicy@list'],
                ['name' => 'Create', 'value' => 'create', 'policy' => 'App\Policies\ClassSchedulePolicy@create'],
                ['name' => 'Update', 'value' => 'update', 'policy' => 'App\Policies\ClassSchedulePolicy@update'],
                ['name' => 'Delete', 'value' => 'delete', 'policy' => 'App\Policies\ClassSchedulePolicy@delete'],
            ]
        ],
        [
            'name' => 'ClassStudent',
            'id'   => 'classStudent',
            'data' => [
                ['name' => 'List', 'value' => 'list', 'policy' => 'App\Policies\ClassStudentPolicy@list'],
                ['name' => 'Create', 'value' => 'create', 'policy' => 'App\Policies\ClassStudentPolicy@create'],
                ['name' => 'Update', 'value' => 'update', 'policy' => 'App\Policies\ClassStudentPolicy@update'],
                ['name' => 'Delete', 'value' => 'delete', 'policy' => 'App\Policies\ClassStudentPolicy@delete'],
            ]
        ],
        [
            'name' => 'Reschedule',
            'id'   => 'reschedule',
            'data' => [
                ['name' => 'List', 'value' => 'list', 'policy' => 'App\Policies\ReschedulePolicy@list'],
                ['name' => 'Create', 'value' => 'create', 'policy' => 'App\Policies\ReschedulePolicy@create'],
                ['name' => 'Update', 'value' => 'update', 'policy' => 'App\Policies\ReschedulePolicy@update'],
                ['name' => 'Delete', 'value' => 'delete', 'policy' => 'App\Policies\ReschedulePolicy@delete'],
            ]
        ],
        [
            'name' => 'Absence',
            'id'   => 'absence',
            'data' => [
                ['name' => 'List', 'value' => 'list', 'policy' => 'App\Policies\AbsencePolicy@list'],
                ['name' => 'Create', 'value' => 'create', 'policy' => 'App\Policies\AbsencePolicy@create'],
                ['name' => 'Update', 'value' => 'update', 'policy' => 'App\Policies\AbsencePolicy@update'],
                ['name' => 'Delete', 'value' => 'delete', 'policy' => 'App\Policies\AbsencePolicy@delete'],
            ]
        ],
        [
            'name' => 'Payment',
            'id'   => 'payment',
            'data' => [
                ['name' => 'List', 'value' => 'list', 'policy' => 'App\Policies\PaymentPolicy@list'],
                ['name' => 'Create', 'value' => 'create', 'policy' => 'App\Policies\PaymentPolicy@create'],
                ['name' => 'Update', 'value' => 'update', 'policy' => 'App\Policies\PaymentPolicy@update'],
                ['name' => 'Delete', 'value' => 'delete', 'policy' => 'App\Policies\PaymentPolicy@delete'],
            ]
        ],
    ]
];
