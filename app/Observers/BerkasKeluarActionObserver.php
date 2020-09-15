<?php

namespace App\Observers;

use App\BerkasKeluar;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class BerkasKeluarActionObserver
{
    public function created(BerkasKeluar $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'BerkasKeluar'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(BerkasKeluar $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'BerkasKeluar'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(BerkasKeluar $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'BerkasKeluar'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
