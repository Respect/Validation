<?php

declare(strict_types=1);

use Respect\Validation\Validator;

if (!class_exists('v')) {
    class_alias(Validator::class, 'v');
}
