<?php

namespace App\Policies;

use App\Models\admins;
use App\Models\schedulePsychotest;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchedulePsychotestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\admins  $admins
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(admins $admins)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\admins  $admins
     * @param  \App\Models\schedulePsychotest  $schedulePsychotest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(admins $admins, schedulePsychotest $schedulePsychotest)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\admins  $admins
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(admins $admins)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\admins  $admins
     * @param  \App\Models\schedulePsychotest  $schedulePsychotest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(admins $admins, schedulePsychotest $schedulePsychotest)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\admins  $admins
     * @param  \App\Models\schedulePsychotest  $schedulePsychotest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(admins $admins, schedulePsychotest $schedulePsychotest)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\admins  $admins
     * @param  \App\Models\schedulePsychotest  $schedulePsychotest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(admins $admins, schedulePsychotest $schedulePsychotest)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\admins  $admins
     * @param  \App\Models\schedulePsychotest  $schedulePsychotest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(admins $admins, schedulePsychotest $schedulePsychotest)
    {
        //
    }
}
