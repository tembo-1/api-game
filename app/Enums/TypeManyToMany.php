<?php

namespace App\Enums;

enum TypeManyToMany
{
    /**
     * Select the systematic filling of the
     * table relative to the first model
     */
    case FIRST_RANDOM;

    /**
     * Select random filling of the
     * table relative to the first model
     */
    case FIRST_FILL;
}
