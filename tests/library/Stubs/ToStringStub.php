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

namespace Respect\Validation\Test\Stubs;

/**
 * Stub to test classes that implement the __toString() method.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ToStringStub
{
    /**
     * @var string
     */
    private $value;

    /**
     * Initializes the object with the value that will be returned when the
     * object is converted to string.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Returns the value defined in the constructor.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
