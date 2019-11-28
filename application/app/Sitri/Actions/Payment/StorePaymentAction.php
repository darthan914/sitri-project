<?php


namespace App\Sitri\Actions\Payment;


use App\Sitri\Models\Admin\Payment;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StorePaymentAction
{
    /**
     * @param array $request
     *
     * @return Builder|Model
     */
    public function execute(array $request)
    {
        return Payment::query()->create($request);
    }
}
