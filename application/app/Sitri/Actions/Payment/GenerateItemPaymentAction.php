<?php


namespace App\Sitri\Actions\Payment;


use App\Sitri\Repositories\Item\ItemRepositoryInterface;

class GenerateItemPaymentAction
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

    public function execute(array &$request)
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
    }
}
