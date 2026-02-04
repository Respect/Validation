<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use InvalidArgumentException;
use ReflectionClass;
use Respect\Validation\Validator;

use function sprintf;

final class TemplateRegistry
{
    /** @var array<class-string<Validator>, array<Template>> */
    private array $templates = [];

    /**
     * @param class-string<Validator> $validatorClass
     *
     * @return array<Template>
     */
    public function getTemplates(string $validatorClass): array
    {
        if (!isset($this->templates[$validatorClass])) {
            $reflection = new ReflectionClass($validatorClass);
            foreach ($reflection->getAttributes(Template::class) as $attribute) {
                $this->templates[$validatorClass][] = $attribute->newInstance();
            }
        }

        return $this->templates[$validatorClass] ?? [];
    }

    /** @param class-string<Validator> $validatorClass */
    public function get(string $validatorClass, string $id = Validator::TEMPLATE_STANDARD): Template
    {
        foreach ($this->getTemplates($validatorClass) as $template) {
            if ($template->id === $id) {
                return $template;
            }
        }

        throw new InvalidArgumentException(sprintf(
            'Template with id "%s" not found in validator "%s".',
            $id,
            $validatorClass,
        ));
    }
}
