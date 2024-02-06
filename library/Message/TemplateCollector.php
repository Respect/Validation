<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use ReflectionClass;

final class TemplateCollector
{
    /** @var array<string, array<Template>> */
    private array $templates = [];

    /**
     * @return array<Template>
     */
    public function extract(object $object): array
    {
        if (!isset($this->templates[$object::class])) {
            $reflection = new ReflectionClass($object);
            foreach ($reflection->getAttributes(Template::class) as $attribute) {
                $this->templates[$object::class][] = $attribute->newInstance();
            }
        }

        return $this->templates[$object::class] ?? [];
    }
}
