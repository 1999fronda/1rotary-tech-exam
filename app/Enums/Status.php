<?php

namespace App\Enums;

enum Status: string
{
    case Pending = 'pending';
    case InProgress = 'in progress';
    case Completed = 'completed';
}
