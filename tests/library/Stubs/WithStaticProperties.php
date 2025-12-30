<?php

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

final class WithStaticProperties
{
    public const string PUBLIC_VALUE = 'public';
    public const string PROTECTED_VALUE = 'protected';
    public const string PRIVATE_VALUE = 'private';

    public static string $public = self::PUBLIC_VALUE;

    protected static string $protected = self::PROTECTED_VALUE;

    private static string $private = self::PRIVATE_VALUE; // @phpstan-ignore-line
}
