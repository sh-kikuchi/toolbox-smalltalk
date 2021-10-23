<?php

namespace App\Policies;

use App\Channel;
use App\User;
use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChannelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Channel  $channel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Channel $channel)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Channel  $channel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Channel $channel)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Channel  $channel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Channel $channel)
    {
        $admin = Admin::where('user_id',$user->id)->where('channel_id',$channel->id)->first();
        return $user->id === $admin->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Channel  $channel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function destroy(User $user, Channel $channel)
    {
        //
        $admin = Admin::where('user_id',$user->id)->where('channel_id',$channel->id)->first();
        return $user->id === $admin->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Channel  $channel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Channel $channel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Channel  $channel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Channel $channel)
    {
        //
    }
}
