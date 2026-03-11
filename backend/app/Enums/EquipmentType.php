<?php

namespace App\Enums;

enum EquipmentType: string
{
    case BICYCLE = 'bicycle';
    case ELECTRIC_BIKE = 'electric_bike';
    case SCOOTER = 'scooter';
    case ELECTRIC_SCOOTER = 'electric_scooter';
    case ROLLER = 'roller';
}