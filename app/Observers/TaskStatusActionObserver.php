<?php

namespace App\Observers;

use App\Notifications\DataChangeEmailNotification;
use App\TaskStatus;
use Illuminate\Support\Facades\Notification;

class TaskStatusActionObserver
{
    public function created(TaskStatus $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'TaskStatus'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(TaskStatus $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'TaskStatus'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(TaskStatus $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'TaskStatus'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
