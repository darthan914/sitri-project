<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Item\StoreItemRequest;
use App\Http\Requests\Admin\Item\UpdateItemRequest;
use App\Sitri\Actions\Item\DeleteItemAction;
use App\Sitri\Actions\Item\StoreItemAction;
use App\Sitri\Actions\Item\UpdateItemAction;
use App\Sitri\Repositories\Item\ItemRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    /**
     * @var ItemRepositoryInterface
     */
    private $itemRepository;

    /**
     * ItemController constructor.
     *
     * @param ItemRepositoryInterface $itemRepository
     */
    public function __construct(ItemRepositoryInterface $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.item.index');
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function dataTable()
    {
        $items = $this->itemRepository->all();

        $dataTable = Datatables::of($items);

        $dataTable->addColumn('action', function ($item) {
            return view('admin.item.datatable.action', compact('item'));
        });

        $dataTable->editColumn('value', function ($item) {
            return 'Rp. '.number_format($item['value']);
        });

        return $dataTable->make(true);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.item.create');
    }

    /**
     * @param StoreItemRequest $request
     * @param StoreItemAction  $action
     *
     * @return RedirectResponse
     */
    public function store(StoreItemRequest $request, StoreItemAction $action)
    {
        $request->validated();

        $action->execute($request->all());

        return redirect()->route('admin.item.index')->with('success', 'Data has been added');
    }

    /**
     * @param int $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $item = $this->itemRepository->find($id);

        return view('admin.item.edit', compact('item'));
    }

    /**
     * @param int               $id
     * @param UpdateItemRequest $request
     * @param UpdateItemAction  $action
     *
     * @return RedirectResponse
     */
    public function update($id, UpdateItemRequest $request, UpdateItemAction $action)
    {
        $request->validated();

        try {
            $action->execute($id, $request->all());
        } catch (Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());

        }

        return redirect()->route('admin.item.index')->with('success', 'Data has been updated');
    }

    /**
     * @param int              $id
     * @param DeleteItemAction $action
     *
     * @return JsonResponse
     */
    public function delete($id, DeleteItemAction $action)
    {
        try {
            $action->execute($id);
        } catch (Exception $e) {
            return response()->json(['messages' => $e->getMessage()]);
        }

        return response()->json(['messages' => 'Data has been deleted!']);
    }
}
