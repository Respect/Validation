<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Markdown\Linters;

use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;
use Respect\Dev\Markdown\File;
use Respect\Dev\Markdown\Linter;

use function array_filter;
use function array_keys;
use function array_shift;
use function array_unshift;
use function basename;
use function count;
use function implode;
use function is_object;
use function preg_match;
use function preg_match_all;
use function preg_replace;
use function sprintf;
use function str_contains;
use function str_starts_with;
use function strrpos;
use function substr;
use function trim;

use const PHP_EOL;

/**
 * @psalm-type Parameter = array{
 *     name: string,
 *     variadic: bool,
 *     types: array<string>,
 *     optional: bool
 * }
 */
final readonly class ValidatorHeaderLinter implements Linter
{
    public function lint(File $file): File
    {
        if (!str_contains($file->filename, '/validators/')) {
            return $file;
        }

        $lines = $file->content->toArray();

        while (($line = array_shift($lines)) !== false) {
            if (preg_match('/^(# .+|- .+|<!--+|-->|SPDX-.+|)$/', $line) === 0) {
                array_unshift($lines, $line);
                break;
            }
        }

        $validator = basename($file->filename, '.md');

        $content = $file->content->extractSpdx();

        $content->h1($validator);

        $reflectionClass = new ReflectionClass('Respect\\Validation\\Validators\\' . $validator);
        foreach ($this->getContracts($reflectionClass->getConstructor()) as $contract) {
            $content->listItem(sprintf('`%s(%s)`', $validator, $contract));
        }

        $content->emptyLine();
        $content->raw(...$lines);

        return $file->withContent($content);
    }

    /** @return array<int, string> */
    private function getContracts(ReflectionMethod|null $constructor): array
    {
        if ($constructor === null) {
            return [$this->buildContract([])];
        }

        $comment = $constructor->getDocComment();
        $docBlockParameterTypes = [];
        if ($comment) {
            $rawComment = preg_replace('@(/\*\* *| +\* +| +\*/)@', '', $comment) . PHP_EOL;

            preg_match_all('/^@param ([^$]+) \$([a-zA-Z0-1]+)$/', $rawComment, $matches);
            foreach (array_keys($matches[0]) as $key) {
                $parameterName = $matches[2][$key];
                $parameterType = $matches[1][$key];
                $docBlockParameterTypes[$parameterName] = $parameterType;
            }
        }

        $parameters = [];
        foreach ($constructor->getParameters() as $reflectionParameter) {
            $parameter = $this->getParameter($reflectionParameter);
            if ($parameter === null) {
                continue;
            }

            $name = $parameter['name'];
            if (isset($docBlockParameterTypes[$name])) {
                $parameter['types'] = [$docBlockParameterTypes[$name]];
            }

            $parameters[] = $parameter;
        }

        $displayed = array_filter($parameters, static fn($parameter) => $parameter['optional'] === false);
        $optional = array_filter($parameters, static fn($parameter) => $parameter['optional'] === true);

        $contracts = [$this->buildContract($displayed)];
        foreach ($optional as $parameter) {
            $displayed[] = $parameter;
            $contracts[] = $this->buildContract($displayed);
        }

        return $contracts;
    }

    /** @param Parameter $parameters */
    private function buildContract(array $parameters): string
    {
        $stringParameters = [];
        foreach ($parameters as $parameter) {
            $stringParameter = implode('|', $parameter['types']) . ' ';
            if ($parameter['variadic']) {
                $stringParameter .= '...';
            }

            $stringParameter .= '$' . $parameter['name'];

            $stringParameters[] = trim($stringParameter);
        }

        return implode(', ', $stringParameters);
    }

    private function filterType(string $type): string
    {
        if (!str_contains($type, '\\')) {
            return $type;
        }

        return substr($type, strrpos($type, '\\') + 1);
    }

    /** @return Parameter|null */
    private function getParameter(ReflectionParameter $reflection): array|null
    {
        $parameter = [
            'name' => $reflection->getName(),
            'variadic' => $reflection->isVariadic(),
            'types' => [],
            'optional' => false,
        ];

        $type = $reflection->getType();
        if ($type instanceof ReflectionUnionType) {
            foreach ($type->getTypes() as $subType) {
                $parameter['types'][] = $this->filterType($subType->getName());
            }
        } elseif ($type instanceof ReflectionNamedType) {
            if (
                str_starts_with($type->getName(), 'Sokil')
                || str_starts_with($type->getName(), 'Egulias')
                || $type->getName() === 'finfo'
            ) {
                return null;
            }

            $parameter['types'][] = $this->filterType($type->getName());
        }

        if (!$reflection->isDefaultValueAvailable()) {
            return ['optional' => $reflection->isOptional()] + $parameter;
        }

        if (count($parameter['types']) > 1 || $reflection->isVariadic()) {
            return ['optional' => false] + $parameter;
        }

        $defaultValue = $reflection->getDefaultValue();
        if (is_object($defaultValue)) {
            return ['optional' => true] + $parameter;
        }

        return ['optional' => true] + $parameter;
    }
}
