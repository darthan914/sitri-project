<?php


namespace App\Sitri\Actions\Payment;


use App\Sitri\Models\Admin\Payment;
use App\Sitri\Repositories\Item\ItemRepositoryInterface;
use App\Sitri\Repositories\Payment\PaymentRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StorePaymentAction
{
    /**
     * @var ItemRepositoryInterface
     */
    private $itemRepository;
    /**
     * @var PaymentRepositoryInterface
     */
    private $paymentRepository;

    /**
     * StorePaymentAction constructor.
     *
     * @param ItemRepositoryInterface    $itemRepository
     * @param PaymentRepositoryInterface $paymentRepository
     */
    public function __construct(ItemRepositoryInterface $itemRepository, PaymentRepositoryInterface $paymentRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * @param array $request
     *
     * @return Builder|Model
     */
    public function execute(array $request)
    {
        (new GenerateItemPaymentAction($this->itemRepository))->execute($request);
        $request['no_payment'] = $this->paymentRepository->generateNoPayment();
        $request['year'] = Carbon::now()->year;

        return Payment::query()->create($request);
    }
}
