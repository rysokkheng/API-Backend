<?php

namespace App\Criteria;

use App\Models\BaseModel;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class RecordStatusCriteria.
 *
 * @package namespace App\Criteria;
 */
class RecordStatusCriteria implements CriteriaInterface
{

    public function __construct()
    {
        //
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $classModel = $model;
        $model = $model
            ->where(function ($query) use ($classModel) {
                return $query->where($classModel::RECORD_STATUS_FIELD, $classModel::RECORD_STATUS_ACTIVE);
            });
        return $model;
    }
}
