<?php

namespace Jetiradoro\SessionManager\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session as SessionFacade;
use Illuminate\Support\Facades\Auth;

class Session extends Model
{
    public $table = 'sessions';
    protected $fillable = ['user_id'];


    /**
     * {@inheritdoc}
     */
    public $timestamps = false;

    /**
     * Get time format last action
     * @return string
     */
    public function getlastConnectionAttribute()
    {
        return Carbon::createFromTimestamp($this->last_activity)->format('d/m/Y H:i:s');
    }

    /**
     * Returns the user that belongs to this entry.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Returns all the users within the given activity.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  int                                   $limit
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActivity($query)
    {

        $lastActivity = strtotime(Carbon::now()->subMinutes(config('session-manager.time_from_last_conn')));

        return $query->where('last_activity', '>=', $lastActivity);
    }

    /**
     * Returns all the guest users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGuests(Builder $query)
    {
        return $query->whereNull('user_id');
    }

    /**
     * Returns all the registered users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRegistered(Builder $query)
    {
        return $query->whereNotNull('user_id')->with('user');
    }

    /**
     * Returns all the connected users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeConnected(Builder $query)
    {
        $lastActivity = strtotime(Carbon::now()->subMinutes(config('session-manager.time_from_last_conn')));
        return $query->where('last_activity', '<=', $lastActivity)->whereNotNull('user_id')->with('user');
    }


    /**
     * Updates the session of the current user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpdateCurrent(Builder $query)
    {
        $user = auth()->user();

        return $query->where('id', SessionFacade::getId())->update([
            'user_id' => $user ? $user->username : null
        ]);
    }

    /**
     * Elimina la sessió actual
     *
     * @return mixed
     */
    public static function destroyCurrent(){

        return self::destroy(SessionFacade::getId());
    }
}
