<?php


namespace App\Sitri\Actions\Reschedule;


use App\Sitri\Models\Admin\Reschedule;
use App\Sitri\Repositories\Reschedule\RescheduleRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StoreRescheduleAction
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
     * @param array $request
     *
     * @return Builder|Model
     * @throws Exception
     */
    public function execute(array $request)
    {
        (new CheckRescheduleAction($this->rescheduleRepository))->check($request);

        return Reschedule::query()->create($request);
    }
}
