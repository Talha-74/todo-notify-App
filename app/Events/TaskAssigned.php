<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TaskAssigned Implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task;
    public $user;
    public $assigner;
    public $message;
    /**
     * Create a new event instance.
     */


public function __construct($task, $user)
{
    $this->task = $task;
    $this->user = $user;
    $this->assigner = Auth::user()->name;
    $this->message = "{$this->assigner} has assigned the '{$task->title}' task to {$this->user}.";
}

    // public function broadcastOn(): array
    // {
    //     return [
    //         new PrivateChannel('tasks'),
    //     ];
    // }
     public function broadcastOn()
  {
      return ['tasks'];
  }

  public function broadcastAs()
  {
      return 'TaskAssigned';
  }
}
