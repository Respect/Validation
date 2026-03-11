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
use ReflectionParameter;
use Respect\Dev\CodeGen\CodeGenerator;
use Respect\Dev\CodeGen\Config;
use Respect\Dev\CodeGen\InterfaceConfig;
use Respect\Dev\CodeGen\NamespaceScanner;

use function file_get_contents;
use function in_array;
use function is_file;
use function is_readable;
use function ksort;

final class MixinGenerator implements CodeGenerator
{
    /** @param array<InterfaceConfig> $interfaces */
    public function __construct(
        private readonly Config $config,
        private readonly MethodBuilder $methodBuilder = new MethodBuilder(),
        private readonly array $interfaces = [],
    ) {
    }

    /** @return array<string, string> filename => content */
    public function generate(): array
    {
        $nodes = NamespaceScanner::scan($this->config->sourceDir, $this->config->sourceNamespace);
        $prefixes = $this->discoverPrefixes($nodes);
        $filters = $this->discoverFilters($nodes);

        $files = [];

        foreach ($this->interfaces as $interfaceConfig) {
            $prefixInterfaceNames = [];

            foreach ($prefixes as $prefix) {
                $interfaceName = $prefix['name'] . $interfaceConfig->suffix;
                $prefixInterfaceNames[] = $this->config->outputNamespace . '\\' . $interfaceName;

                $this->generateInterface(
                    $interfaceName,
                    $interfaceConfig,
                    $nodes,
                    $filters,
                    $prefix,
                    $files,
                );
            }

            $this->generateRootInterface(
                $interfaceConfig,
                $prefixInterfaceNames,
                $nodes,
                $filters,
                $files,
            );
        }

        return $files;
    }

    /**
     * @param array<string, ReflectionClass> $nodes
     *
     * @return array<array{name: string, prefix: string, requireInclusion: bool, prefixParameter: ?ReflectionParameter}>
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

            $constructor = $reflection->getConstructor();
            $prefixParameter = null;

            if ($mixin->prefixParameter && $constructor !== null) {
                $parameters = $constructor->getParameters();
                if ($parameters !== []) {
                    $prefixParameter = $parameters[0];
                }
            }

            $prefixes[$mixin->prefix] = [
                'name' => $reflection->getShortName(),
                'prefix' => $mixin->prefix,
                'requireInclusion' => $mixin->requireInclusion,
                'prefixParameter' => $prefixParameter,
            ];
        }

        ksort($prefixes);

        return $prefixes;
    }

    /**
     * @param array<string, ReflectionClass> $nodes
     *
     * @return array<string, Mixin>
     */
    private function discoverFilters(array $nodes): array
    {
        $filters = [];

        foreach ($nodes as $name => $reflection) {
            $attributes = $reflection->getAttributes(Mixin::class);
            if ($attributes === []) {
                continue;
            }

            $filters[$name] = $attributes[0]->newInstance();
        }

        return $filters;
    }

    /**
     * @param array<string, ReflectionClass> $nodes
     * @param array<string, Mixin> $filters
     * @param array{name: string, prefix: string, requireInclusion: bool, prefixParameter: ?ReflectionParameter} $prefix
     * @param array<string, string> $files
     */
    private function generateInterface(
        string $interfaceName,
        InterfaceConfig $config,
        array $nodes,
        array $filters,
        array $prefix,
        array &$files,
    ): void {
        $namespace = new PhpNamespace($this->config->outputNamespace);
        $interface = $namespace->addInterface($interfaceName);

        foreach ($nodes as $name => $reflection) {
            $mixin = $filters[$name] ?? null;

            if ($prefix['requireInclusion']) {
                if ($mixin === null || !in_array($prefix['prefix'], $mixin->include, true)) {
                    continue;
                }
            } elseif ($mixin !== null && in_array($prefix['prefix'], $mixin->exclude, true)) {
                continue;
            }

            $method = $this->methodBuilder->build(
                $namespace,
                $reflection,
                $config->returnType,
                $prefix['prefix'],
                $config->static,
                $prefix['prefixParameter'],
            );

            $interface->addMember($method);
        }

        $this->addFile($interfaceName, $namespace, $files);
    }

    /**
     * @param array<string> $prefixInterfaceNames
     * @param array<string, ReflectionClass> $nodes
     * @param array<string, Mixin> $filters
     * @param array<string, string> $files
     */
    private function generateRootInterface(
        InterfaceConfig $config,
        array $prefixInterfaceNames,
        array $nodes,
        array $filters,
        array &$files,
    ): void {
        $interfaceName = $config->suffix;
        $namespace = new PhpNamespace($this->config->outputNamespace);
        $interface = $namespace->addInterface($interfaceName);

        foreach ($config->rootExtends as $extend) {
            $namespace->addUse($extend);
            $interface->addExtend($extend);
        }

        foreach ($prefixInterfaceNames as $prefixInterfaceName) {
            $namespace->addUse($prefixInterfaceName);
            $interface->addExtend($prefixInterfaceName);
        }

        if ($config->rootComment !== null) {
            $interface->addComment($config->rootComment);
        }

        foreach ($config->rootUses as $use) {
            $namespace->addUse($use);
        }

        foreach ($nodes as $reflection) {
            $method = $this->methodBuilder->build(
                $namespace,
                $reflection,
                $config->returnType,
                null,
                $config->static,
            );

            $interface->addMember($method);
        }

        $this->addFile($interfaceName, $namespace, $files);
    }

    /** @param array<string, string> $files */
    private function addFile(string $interfaceName, PhpNamespace $namespace, array &$files): void
    {
        $filename = $this->config->outputDir . '/' . $interfaceName . '.php';

        $printer = new Printer();
        $printer->wrapLength = 300;

        $existingContent = '';
        if (is_file($filename) && is_readable($filename)) {
            $existingContent = file_get_contents($filename) ?: '';
        }

        $formattedContent = $this->config->outputFormatter->format(
            $printer->printNamespace($namespace),
            $existingContent,
        );

        $files[$filename] = $formattedContent;
    }
}
