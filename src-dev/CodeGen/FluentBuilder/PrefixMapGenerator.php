<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\CodeGen\FluentBuilder;

use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\Printer;
use ReflectionClass;
use Respect\Dev\CodeGen\CodeGenerator;
use Respect\Dev\CodeGen\Config;
use Respect\Dev\CodeGen\NamespaceScanner;

use function array_keys;
use function ctype_upper;
use function file_get_contents;
use function is_file;
use function is_readable;
use function ksort;
use function lcfirst;
use function str_starts_with;
use function strlen;
use function uksort;

final class PrefixMapGenerator implements CodeGenerator
{
    public function __construct(
        private readonly Config $config,
        private readonly string $outputClassName,
    ) {
    }

    /** @return array<string, string> filename => content */
    public function generate(): array
    {
        $nodes = NamespaceScanner::scan($this->config->sourceDir, $this->config->sourceNamespace);
        $prefixes = $this->discoverPrefixes($nodes);
        $composable = $this->buildComposable($nodes, $prefixes);
        $composableWithArgument = $this->buildComposableWithArgument($prefixes);

        $namespace = new PhpNamespace($this->config->outputNamespace);
        $class = $namespace->addClass($this->outputClassName);
        $class->setFinal();

        $class->addConstant('COMPOSABLE', $composable)->setPublic()->setType('array');
        $class->addConstant('COMPOSABLE_WITH_ARGUMENT', $composableWithArgument)->setPublic()->setType('array');

        $printer = new Printer();
        $printer->wrapLength = 300;

        $outputFile = $this->config->outputDir . '/' . $this->outputClassName . '.php';

        $existingContent = '';
        if (is_file($outputFile) && is_readable($outputFile)) {
            $existingContent = file_get_contents($outputFile) ?: '';
        }

        $formattedContent = $this->config->outputFormatter->format(
            $printer->printNamespace($namespace),
            $existingContent,
        );

        return [$outputFile => $formattedContent];
    }

    /**
     * @param array<string, ReflectionClass> $nodes
     *
     * @return array<string, array{prefix: string, prefixParameter: bool}>
     */
    private function discoverPrefixes(array $nodes): array
    {
        $prefixes = [];

        foreach ($nodes as $reflection) {
            $attributes = $reflection->getAttributes(Mixin::class);
            if ($attributes === []) {
                continue;
            }

            $mixin = $attributes[0]->newInstance();
            if ($mixin->prefix === null) {
                continue;
            }

            $prefixes[$mixin->prefix] = [
                'prefix' => $mixin->prefix,
                'prefixParameter' => $mixin->prefixParameter,
            ];
        }

        ksort($prefixes);

        return $prefixes;
    }

    /**
     * @param array<string, ReflectionClass> $nodes
     * @param array<string, array{prefix: string, prefixParameter: bool}> $prefixes
     *
     * @return array<string, true>
     */
    private function buildComposable(array $nodes, array $prefixes): array
    {
        $composable = [];

        foreach (array_keys($prefixes) as $prefix) {
            $composable[$prefix] = true;

            foreach (array_keys($nodes) as $name) {
                $lcName = lcfirst($name);
                if ($lcName === $prefix) {
                    continue;
                }

                if (!str_starts_with($lcName, $prefix)) {
                    continue;
                }

                if (!ctype_upper($lcName[strlen($prefix)])) {
                    continue;
                }

                $composable[$lcName] = true;
            }
        }

        uksort($composable, static fn(string $a, string $b): int => strlen($b) <=> strlen($a) ?: $a <=> $b);

        return $composable;
    }

    /**
     * @param array<string, array{prefix: string, prefixParameter: bool}> $prefixes
     *
     * @return array<string, true>
     */
    private function buildComposableWithArgument(array $prefixes): array
    {
        $composableWithArgument = [];

        foreach ($prefixes as $prefix => $info) {
            if (!$info['prefixParameter']) {
                continue;
            }

            $composableWithArgument[$prefix] = true;
        }

        ksort($composableWithArgument);

        return $composableWithArgument;
    }
}
