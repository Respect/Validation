<?php

namespace Respect\Validation\Validators\Attributes;

use ReflectionFunctionAbstract;
use Respect\Parameter\Resolver;

final class BypassResolver implements Resolver
{
    public function resolve(ReflectionFunctionAbstract $reflection, array $arguments): array
    {
        return $arguments;
    }
}
