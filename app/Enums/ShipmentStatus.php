<?php

namespace App\Enums;

enum ShipmentStatus: int
{
    case Pending = 1;
    case Completed = 2; 
    case Shipped = 3; 
    case Failed = 4; 
}
