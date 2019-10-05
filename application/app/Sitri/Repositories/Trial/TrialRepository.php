<?php


namespace App\Sitri\Repositories\Trial;


use App\Sitri\Models\Admin\ParentTrial;
use Illuminate\Database\Eloquent\Builder;

class TrialRepository implements TrialRepositoryInterface
{

    public function all()
    {
        return ParentTrial::query()->orderBy('name')->get();
    }

    public function getByRequest(array $data)
    {
        $parentTrials = ParentTrial::query();

        $collect = collect($data);

        $search = $collect->get('f_search');
        if (null !== $search && '' !== $search) {
            $parentTrials->where(function (Builder $parentTrials) use ($search) {
                $parentTrials->where('name', 'like', '%' . $search . '%')
                        ->orWhereHas('childTrials', function (Builder $query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                ;
            });
        }

        return $parentTrials->orderBy('name')->get();
    }
}
