<?php


namespace App\Sitri\Actions\Payment;


use App\Sitri\Models\Admin\Payment;
use App\Sitri\Repositories\Item\ItemRepositoryInterface;
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
     * StorePaymentAction constructor.
     *
     * @param ItemRepositoryInterface $itemRepository
     */
    public function __construct(ItemRepositoryInterface $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * @param array $request
     *
     * @return Builder|Model
     */
    public function execute(array $request)
    {
        $items = [];
        foreach ($request['item'] as $key => $item) {
            $getItem = $this->itemRepository->getByName($item);
            if ($getItem) {
                $items[] = [
                    'name'     => $item,
                    'value'    => $getItem['value'],
                    'quantity' => $request['quantity'][$key]
                ];
            }
        }
        $request['items'] = $items;
        $request['no_payment'] = time();

        return Payment::query()->create($request);
    }
}
