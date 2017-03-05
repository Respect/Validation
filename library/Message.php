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

namespace Respect\Validation;

use function Respect\Stringifier\stringify;

final class Message
{
    /**
     * @var string
     */
    private $ruleName;

    /**
     * @var string
     */
    private $template;

    /**
     * @var mixed
     */
    private $input;

    /**
     * @var array
     */
    private $properties;

    /**
     * Initializes the object.
     *
     * @param string $ruleName
     * @param string $template
     * @param mixed  $input
     * @param array  $properties
     */
    public function __construct(string $ruleName, string $template, $input, array $properties = [])
    {
        $this->ruleName = $ruleName;
        $this->template = $template;
        $this->input = $input;
        $this->properties = $properties;
    }

    /**
     * @return string
     */
    public function getRuleName(): string
    {
        return $this->ruleName;
    }

    public function render(string $placeholder = null): string
    {
        $properties = $this->properties + ['placeholder' => $placeholder];
        if (null === $properties['placeholder']) {
            $properties['placeholder'] = stringify($this->input);
        }

        return preg_replace_callback(
            '/{{(\w+)}}/',
            function (array $matches) use ($properties): string {
                $value = $matches[0];
                $placeholder = $matches[1];
                if (array_key_exists($placeholder, $properties)) {
                    $value = $properties[$placeholder];
                }

                if ('placeholder' === $placeholder && is_string($value)) {
                    return $value;
                }

                return stringify($value);
            },
            $this->template
        );
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
