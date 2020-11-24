<?php
/**
 * Created by PhpStorm.
 * User: rysokkheng
 * Date: 2/1/19
 * Time: 11:48 PM
 */
namespace App\Services;


use App\Criteria\RecordStatusCriteria;
use App\Models\BaseModel;
use Illuminate\Http\Response;
use Mockery\Exception;


/**
 * Class BaseService
 * @package App\Services
 */
abstract class SimpleService extends BaseService
{

    public $hasRecordStatus = true;

    /**
     * @return mixed
     */
    public abstract function repository();

    public function __construct()
    {
        if($this->repository() == null) {
            throw new Exception(get_class($this). ' extends from BaseService must implement repository method with returning a repository.');
        }
    }

    public function getByPaginate()
    {
        if($this->hasRecordStatus) {
            $recordStatusCriteria = new RecordStatusCriteria();
            $result = $this->repository()
                        ->pushCriteria($recordStatusCriteria)
                        ->paginate();
        }else{
            $result = $this->repository()->paginate();
        }

        return $this->getSuccessResponseArray(__('success'), $result);
    }

    /**
     * get all record from database
     * @param array $columns
     * @return mixed
     */
    public function getAll($columns = ['*'])
    {
        if($this->hasRecordStatus){
            $result = $this->repository()->findWhere([BaseModel::RECORD_STATUS_FIELD => BaseModel::RECORD_STATUS_ACTIVE], $columns);
        }else{
            $result = $this->repository->all($columns);
        }
        return $this->getSuccessResponseArray(__('success'), $result);
    }

    /**
     * insert record into database
     * @return array
     */
    public function insertData($request)
    {
        try{
            $data = $this->repository()->create($request->all());
            return $this->getSuccessResponseArray(__('global.save_success'), $data);
        }
        catch (\Exception $e)
        {
            return $this->getErrorResponseArray(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * get record from database by Id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $result = $this->repository()->find($id);
        return $this->getSuccessResponseArray(__('success'), $result);
    }

    /**
     * update record in the database based on Id
     * @param $id
     * @return array
     */
    public function updateData($request, $id)
    {
        try{
            $data = $this->repository()->update($request->all(), $id);
            return $this->getSuccessResponseArray(__('global.update_success'), $data);
        }
        catch (\Exception $e){
            return $this->getErrorResponseArray(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * delete record from database by Id
     * @param $id
     * @return array
     */
    public function deleteData($id)
    {
        try {
            $data = $this->repository()->update([BaseModel::RECORD_STATUS_FIELD => BaseModel::RECORD_STATUS_DELETE ], $id);
            return $this->getSuccessResponseArray(__('global.delete_success'), $data);
        } catch (\Exception $e) {
            return $this->getErrorResponseArray(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    public function destroyData($id)
    {
        try {
            $data = $this->repository()->delete($id);
            return $this->getSuccessResponseArray(__('global.delete_success'), $data);
        } catch (\Exception $e) {
            return $this->getErrorResponseArray(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }
}
