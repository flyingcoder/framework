<?php

namespace Litepie\User\Repositories\Eloquent;

use Litepie\Contracts\User\UserRepository as UserRepositoryContract;
use Litepie\Repository\Eloquent\BaseRepository;
use User;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'App\User';
    }

    /**
     * Attach role to user.
     *
     * @param type $roleName
     *
     * @return type
     */
    public function attachRole($roleName)
    {
        return $this->model->attachRole($roleName);
    }

    /**
     * Attach permission to user.
     *
     * @param string $permissionName
     * @param array  $options
     *
     * @return type
     */
    public function attachPermission($permissionName, array $options = [])
    {
        return $this->model->attachPermission($permissionName, $options);
    }

    /**
     * Save a new entity in modal.
     *
     * @param array $attributes
     *
     * @throws ValidatorException
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        $model                 = $this->model->newInstance();
        $attributes['user_id'] = User::users('id');
        $model->fill($attributes);
        $model->password = bcrypt($attributes['password']);
        $model->save();
        $this->resetModel();

        return $model;
    }

    /**
     * Find a user by its id.
     *
     * @param type $id
     *
     * @return type
     */
    public function findUser($id)
    {
        return $this->model->whereId($id)->first();
    }

    /**
     * Activate user with the given id.
     *
     * @param type $id
     *
     * @return type
     */
    public function activate($id)
    {
        $user = $this->model->whereId($id)->whereStatus('New')->first();

        if (is_null($user)) {
            return false;
        }

        if ($user->update(['status' => 'Active'])) {
            return true;
        }

        return false;
    }

}
