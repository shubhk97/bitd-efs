<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $model->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->role == 10)
            return true;
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        if($user->role == 10)
            return true;
        // if($user->role == 7){
        //     if($user->department_name == $model->department_name && $model->role == 5)
        //         return true;
        //     return false;
        // }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        if($user->role == 10)
            return true;
        // if($user->role == 7){
        //     if($user->department_name == $model->department_name && $model->role == 5)
        //         return true;
        //     return false;
        // }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $model->department_name && $model->role == 5)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $model->department_name && $model->role == 5)
                return true;
            return false;
        }
        return false;
    }
}
