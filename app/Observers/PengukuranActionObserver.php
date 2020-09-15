<?php

namespace App\Observers;

use App\Notifications\DataChangeEmailNotification;
use App\Pengukuran;
use Illuminate\Support\Facades\Notification;

class PengukuranActionObserver
{
    public function created(Pengukuran $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Pengukuran'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Pengukuran $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Pengukuran'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Pengukuran $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Pengukuran'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
