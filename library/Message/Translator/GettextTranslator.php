<?php

declare(strict_types=1);

namespace Respect\Validation\Message\Translator;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Message\Translator;

use function function_exists;
use function gettext;

final class GettextTranslator implements Translator
{
    public function __construct()
    {
        if (!function_exists('gettext')) {
            throw new ComponentException('This translator requires the gettext extension');
        }
    }

    public function translate(string $message): string
    {
        return gettext($message);
    }
}
