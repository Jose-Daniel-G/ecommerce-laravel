
<?php

// namespace App\Enums;

enum OrderStatus: int
{
    case Pending = 1;
    case Processing = 2;
    case shipped = 3;
    case Completed = 4;
    case Cancelled = 5;
    case Refounded = 6;
    case Failed = 7;
}
