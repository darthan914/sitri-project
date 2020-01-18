<?php


namespace App\Sitri\Actions\Reschedule;


use App\Sitri\Models\Admin\Reschedule;
use App\Sitri\Repositories\Reschedule\RescheduleRepositoryInterface;
use Exception;

class UpdateRescheduleAction
{
    /**
     * @var RescheduleRepositoryInterface
     */
    private $rescheduleRepository;

    public function __construct(RescheduleRepositoryInterface $rescheduleRepository)
    {
        $this->rescheduleRepository = $rescheduleRepository;
    }

    /**
     * @param int   $rescheduleId
     * @param array $request
     *
     * @return bool
     * @throws Exception
     */
    public function execute($rescheduleId, array $request)
    {
        (new CheckRescheduleAction($this->rescheduleRepository))->check($request);

        return Reschedule::query()->find($rescheduleId)->update($request);
    }
}
