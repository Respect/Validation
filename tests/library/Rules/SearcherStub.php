<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Rules;

use Respect\Validation\Rules\AbstractSearcher;

use function call_user_func;

final class SearcherStub extends AbstractSearcher
{
    /**
     * @var callable
     */
    private $dataSourceCallable;

    public function __construct(callable $dataSourceCallable)
    {
        $this->dataSourceCallable = $dataSourceCallable;
    }

    /**
     * @return array<mixed, array<mixed>>
     */
    protected function getDataSource(mixed $input = null): array
    {
        return call_user_func($this->dataSourceCallable, $input);
    }
}
