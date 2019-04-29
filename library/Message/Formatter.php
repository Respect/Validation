<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use function call_user_func;
use function is_string;
use function preg_replace_callback;
use function Respect\Stringifier\stringify;

final class Formatter
{
    /**
     * @var callable
     */
    private $translator;

    public function __construct(callable $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param mixed $input
     * @param mixed[] $parameters
     */
    public function format(string $template, $input, array $parameters): string
    {
        $parameters['name'] = $parameters['name'] ?? stringify($input);

        return preg_replace_callback(
            '/{{(\w+)}}/',
            static function ($match) use ($parameters) {
                if (!isset($parameters[$match[1]])) {
                    return $match[0];
                }

                $value = $parameters[$match[1]];
                if ($match[1] == 'name' && is_string($value)) {
                    return $value;
                }

                return stringify($value);
            },
            call_user_func($this->translator, $template)
        );
    }
}
