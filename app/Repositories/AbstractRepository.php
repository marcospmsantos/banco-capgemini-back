<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository extends RepositoryInterface
{
    /**
     * @param $params
     * @return Model
     */
    public function create($params): Model
    {
        return $this->model->forceCreate($this->formatParams($params));
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id, $with = [])
    {
        return $this->model->with($with)->find($id);
    }

    /**
     * @param int $int
     * @return mixed
     */
    public function findOrFail(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function findByUserAuth($params)
    {
        if(isset($params['user_id']) && !empty($params['user_id'])) {
            return $this->findOrFail($params['user_id']);
        }
        /**
         * @todo achar o usuario, mas se nao existir um id_user, retorna o usuario logado
         */
    }

    /**
     * @param $entity
     * @param $data
     */
    public function update(Model $entity, $data)
    {
        $entity->forceFill($this->formatParams($data))->save();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function formatParams($params)
    {
        return $params;
    }
}
