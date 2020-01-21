<?php


namespace App\Sitri\Actions\Payment;


use App\Sitri\Models\Admin\Payment;
use App\Sitri\Repositories\Item\ItemRepositoryInterface;

class UpdatePaymentAction
{
    /**
     * @var ItemRepositoryInterface
     */
    private $itemRepository;

    /**
     * UpdatePaymentAction constructor.
     *
     * @param ItemRepositoryInterface $itemRepository
     */
    public function __construct(ItemRepositoryInterface $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * @param int   $paymentId
     * @param array $request
     *
     * @return bool
     */
    public function execute($paymentId, array $request)
    {
        (new GenerateItemPaymentAction($this->itemRepository))->execute($request);
        Payment::query()->find($paymentId)->update($request);

        return true;
    }
}
