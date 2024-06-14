<?php

namespace App\Enums;

enum HttpStatusCodes: int
{
    case OK = 200;
    case CREATED = 201;
    case NO_CONTENT = 204;
}
