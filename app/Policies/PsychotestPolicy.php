<?php

namespace App\Policies;

use App\Models\Psychotest;
use App\Models\admins;
use Illuminate\Auth\Access\HandlesAuthorization;

class PsychotestPolicy
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
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(admins $admins, Psychotest $psychotest)
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
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(admins $admins, Psychotest $psychotest)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\admins  $admins
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(admins $admins, Psychotest $psychotest)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\admins  $admins
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(admins $admins, Psychotest $psychotest)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\admins  $admins
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(admins $admins, Psychotest $psychotest)
    {
        //
    }
}
