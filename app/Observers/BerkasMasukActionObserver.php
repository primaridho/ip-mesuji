<?php

namespace App\Observers;

use App\BerkasMasuk;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class BerkasMasukActionObserver
{
    public function created(BerkasMasuk $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'BerkasMasuk'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(BerkasMasuk $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'BerkasMasuk'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(BerkasMasuk $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'BerkasMasuk'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
