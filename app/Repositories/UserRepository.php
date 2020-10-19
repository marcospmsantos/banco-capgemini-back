<?php

namespace App\Repositories;

use App\Helper\Number;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class UserRepository extends AbstractRepository
{
    protected $model;

    /**
     * UserRepository constructor.
     * @param User $model

     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function fetchOnlyUser(int $id)
    {
        return $this->model->where(['id' => $id])->firstOrFail();
    }

    /**
     * @param int $id
     * @return array
     * @throws \Exception
     */
    public function fetchUser(int $id)
    {
        $user = $this->model->where(['id' => $id])->firstOrFail();
        if (!$user) {
            throw ValidationException::withMessages(['message' => ' Usuário não encontrado']);
        }

        return [
            'user' => $user,
            'authenticated' => true
        ];
    }

    /**
     * @param $email
     * @return mixed
     */
    public function existByEmail($email)
    {
        return $this->model->where(['email' => $email])->exists();
    }

    /**
     * Tenta validar usuário pelo token
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function check(Request $request)
    {
        $id = $request->user()->id;
        return $this->fetchUser($id);
    }

    public function createExterno($data)
    {
        $data = $this->formatParams($data, true);
        return $this->model->forceCreate($data);
    }


    /**
     * NOT IN
     * @param array $notIn
     * @return mixed
     */
    public function whereNotIn(array $notIn)
    {
        return $this->model->whereNotIn('id', $notIn)->get();
    }

    /**
     * IN
     * @param array $in
     * @return mixed
     */
    public function whereIn(array $in)
    {
        return $this->model->whereIn('id', $in)->get();
    }

    /**
     * @param $params
     * @param bool $actionByUser
     * @return array|mixed
     */
    public function formatParams($params, $actionByUser = false)
    {
        $formatted = [];

        if (isset($params['avatar'])) {
            $formatted['avatar'] = $params['avatar'];
        }

        if (isset($params['sexo'])) {
            $formatted['sexo'] = $params['sexo'];
        }

        if (isset($params['birthday'])) {
            $formatted['birthday'] = Date::formatToDataBase($params['birthday']);
        }

        if (isset($params['name'])) {
            $formatted['name'] = ucwords($params['name']);
        }

        if (isset($params['email'])) {
            $formatted['email'] = $params['email'];
        }

        if (isset($params['cpf'])) {
            $formatted['cpf'] = Number::getOnlyNumber($params['cpf']);
        }

        if (isset($params['telefone'])) {
            $formatted['telefone'] = Number::getOnlyNumber($params['telefone']);
        }

        if (isset($params['celular'])) {
            $formatted['celular'] = Number::getOnlyNumber($params['celular']);
        }

        if ($actionByUser) {
            $formatted['password'] = bcrypt($params['password']);
        }

        return $formatted;
    }
}
