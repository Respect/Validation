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

use Countable;

/**
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 */
final class CountableStub implements Countable
{
    /**
     * @var int
     */
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function count(): int
    {
        return $this->value;
    }
}
