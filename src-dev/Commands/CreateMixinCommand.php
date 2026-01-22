<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Commands;

use DirectoryIterator;
use Nette\PhpGenerator\InterfaceType;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\Printer;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;
use Respect\Validation\Mixins\AllBuilder;
use Respect\Validation\Mixins\AllChain;
use Respect\Validation\Mixins\Chain;
use Respect\Validation\Mixins\KeyBuilder;
use Respect\Validation\Mixins\KeyChain;
use Respect\Validation\Mixins\LengthBuilder;
use Respect\Validation\Mixins\LengthChain;
use Respect\Validation\Mixins\MaxBuilder;
use Respect\Validation\Mixins\MaxChain;
use Respect\Validation\Mixins\MinBuilder;
use Respect\Validation\Mixins\MinChain;
use Respect\Validation\Mixins\NotBuilder;
use Respect\Validation\Mixins\NotChain;
use Respect\Validation\Mixins\NullOrBuilder;
use Respect\Validation\Mixins\NullOrChain;
use Respect\Validation\Mixins\PropertyBuilder;
use Respect\Validation\Mixins\PropertyChain;
use Respect\Validation\Mixins\UndefOrBuilder;
use Respect\Validation\Mixins\UndefOrChain;
use Respect\Validation\Validator;
use Respect\Validation\ValidatorBuilder;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use function array_filter;
use function array_merge;
use function count;
use function dirname;
use function file_exists;
use function file_put_contents;
use function implode;
use function in_array;
use function is_object;
use function ksort;
use function lcfirst;
use function preg_replace;
use function shell_exec;
use function sprintf;
use function str_contains;
use function str_starts_with;
use function ucfirst;

#[AsCommand(
    name: 'create:mixin',
    description: 'Generate mixin interfaces from validators',
)]
final class CreateMixinCommand extends Command
{
    private const array NUMBER_RELATED_VALIDATORS = [
        'Between',
        'BetweenExclusive',
        'Equals',
        'Equivalent',
        'Even',
        'Factor',
        'Fibonacci',
        'Finite',
        'GreaterThan',
        'Identical',
        'In',
        'Infinite',
        'LessThan',
        'LessThanOrEqual',
        'GreaterThanOrEqual',
        'Multiple',
        'Odd',
        'PerfectSquare',
        'Positive',
        'PrimeNumber',
    ];

    private const array STRUCTURE_RELATED_VALIDATORS = [
        'Exists',
        'Key',
        'KeyExists',
        'KeyOptional',
        'KeySet',
        'NullOr',
        'UndefOr',
        'Property',
        'PropertyExists',
        'PropertyOptional',
        'Attributes',
        'Templated',
        'Named',
    ];

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Generating mixin interfaces');

        // Scan validators directory
        $srcDir = dirname(__DIR__, 2) . '/src';
        $validatorsDir = $srcDir . '/Validators';
        $validators = $this->scanValidators($validatorsDir);

        $io->text(sprintf('Found %d validators', count($validators)));

        // Define mixins
        $mixins = [
            ['All', 'all', [], array_merge(['All'], self::STRUCTURE_RELATED_VALIDATORS)],
            ['Key', 'key', [], self::STRUCTURE_RELATED_VALIDATORS],
            ['Length', 'length', self::NUMBER_RELATED_VALIDATORS, []],
            ['Max', 'max', self::NUMBER_RELATED_VALIDATORS, []],
            ['Min', 'min', self::NUMBER_RELATED_VALIDATORS, []],
            ['Not', 'not', [], ['Not', 'NullOr', 'UndefOr', 'Attributes', 'Templated', 'Named']],
            ['NullOr', 'nullOr', [], ['NullOr', 'Blank', 'Undef', 'UndefOr', 'Templated', 'Named']],
            ['Property', 'property', [], self::STRUCTURE_RELATED_VALIDATORS],
            ['UndefOr', 'undefOr', [], ['NullOr', 'Blank', 'Undef', 'UndefOr', 'Attributes', 'Templated', 'Named']],
            ['', null, [], []],
        ];

        $io->section('Generating mixin interfaces');

        foreach ($mixins as [$name, $prefix, $allowList, $denyList]) {
            $io->text(sprintf('Generating %sBuilder and %sChain', $name ?: 'Base', $name ?: 'Base'));

            $chainedNamespace = new PhpNamespace('Respect\\Validation\\Mixins');
            $chainedNamespace->addUse(Validator::class);
            $chainedInterface = $chainedNamespace->addInterface($name . 'Chain');

            $staticNamespace = new PhpNamespace('Respect\\Validation\\Mixins');
            $staticNamespace->addUse(Validator::class);
            $staticInterface = $staticNamespace->addInterface($name . 'Builder');

            if ($name === '') {
                $chainedInterface->addExtend(Validator::class);
                $chainedInterface->addExtend(AllChain::class);
                $chainedInterface->addExtend(KeyChain::class);
                $chainedInterface->addExtend(LengthChain::class);
                $chainedInterface->addExtend(MaxChain::class);
                $chainedInterface->addExtend(MinChain::class);
                $chainedInterface->addExtend(NotChain::class);
                $chainedInterface->addExtend(NullOrChain::class);
                $chainedInterface->addExtend(PropertyChain::class);
                $chainedInterface->addExtend(UndefOrChain::class);
                $chainedInterface->addComment('@mixin \\' . ValidatorBuilder::class);

                $staticInterface->addExtend(AllBuilder::class);
                $staticInterface->addExtend(KeyBuilder::class);
                $staticInterface->addExtend(LengthBuilder::class);
                $staticInterface->addExtend(MaxBuilder::class);
                $staticInterface->addExtend(MinBuilder::class);
                $staticInterface->addExtend(NotBuilder::class);
                $staticInterface->addExtend(NullOrBuilder::class);
                $staticInterface->addExtend(PropertyBuilder::class);
                $staticInterface->addExtend(UndefOrBuilder::class);
            }

            foreach ($validators as $originalName => $reflection) {
                $this->addMethodToInterface(
                    $originalName,
                    $staticInterface,
                    $reflection,
                    $prefix,
                    $allowList,
                    $denyList,
                );
                $this->addMethodToInterface(
                    $originalName,
                    $chainedInterface,
                    $reflection,
                    $prefix,
                    $allowList,
                    $denyList,
                );
            }

            $printer = new Printer();
            $printer->wrapLength = 115;

            $this->overwriteFile($printer->printNamespace($staticNamespace), $staticInterface->getName());
            $this->overwriteFile($printer->printNamespace($chainedNamespace), $chainedInterface->getName());
        }

        // Run code beautifier
        $io->section('Running code beautifier');
        $mixinsDir = $srcDir . '/Mixins';
        $phpcbfPath = dirname(__DIR__, 2) . '/vendor/bin/phpcbf';

        if (file_exists($phpcbfPath)) {
            shell_exec($phpcbfPath . ' ' . $mixinsDir);
            $io->success('Code beautified');
        } else {
            $io->warning('phpcbf not found, skipping code beautification');
        }

        $io->success('Mixin interfaces generated successfully');

        return Command::SUCCESS;
    }

    /** @return array<string, ReflectionClass> */
    private function scanValidators(string $directory): array
    {
        $names = [];

        foreach (new DirectoryIterator($directory) as $file) {
            if (!$file->isFile()) {
                continue;
            }

            $className = 'Respect\\Validation\\Validators\\' . $file->getBasename('.php');
            $reflection = new ReflectionClass($className);

            if ($reflection->isAbstract()) {
                continue;
            }

            $names[$reflection->getShortName()] = $reflection;
        }

        ksort($names);

        return $names;
    }

    /**
     * @param array<string> $allowList
     * @param array<string> $denyList
     */
    private function addMethodToInterface(
        string $originalName,
        InterfaceType $interfaceType,
        ReflectionClass $reflection,
        string|null $prefix,
        array $allowList,
        array $denyList,
    ): void {
        if ($allowList !== [] && !in_array($reflection->getShortName(), $allowList, true)) {
            return;
        }

        if ($denyList !== [] && in_array($reflection->getShortName(), $denyList, true)) {
            return;
        }

        $name = $prefix ? $prefix . ucfirst($originalName) : lcfirst($originalName);
        $method = $interfaceType->addMethod($name)->setPublic()->setReturnType(Chain::class);

        if (str_contains($interfaceType->getName(), 'Builder')) {
            $method->setStatic();
        }

        if ($prefix === 'key') {
            $method->addParameter('key')->setType('int|string');
        }

        if ($prefix === 'property') {
            $method->addParameter('propertyName')->setType('string');
        }

        $reflectionConstructor = $reflection->getConstructor();
        if ($reflectionConstructor === null) {
            return;
        }

        $comment = $reflectionConstructor->getDocComment();
        if ($comment) {
            $method->addComment(preg_replace('@(/\*\* *| +\* +| +\*/)@', '', $comment));
        }

        foreach ($reflectionConstructor->getParameters() as $reflectionParameter) {
            $this->addParameterToMethod($method, $reflectionParameter);
        }
    }

    private function addParameterToMethod(Method $method, ReflectionParameter $reflectionParameter): void
    {
        if ($reflectionParameter->isVariadic()) {
            $method->setVariadic();
        }

        $type = $reflectionParameter->getType();
        $types = [];

        if ($type instanceof ReflectionUnionType) {
            foreach ($type->getTypes() as $subType) {
                $types[] = $subType->getName();
            }
        } elseif ($type instanceof ReflectionNamedType) {
            $types[] = $type->getName();
            if (
                str_starts_with($type->getName(), 'Sokil')
                || str_starts_with($type->getName(), 'Egulias')
                || $type->getName() === 'finfo'
            ) {
                return;
            }
        }

        $parameter = $method->addParameter($reflectionParameter->getName());
        $parameter->setType(implode('|', $types));

        if (!$reflectionParameter->isDefaultValueAvailable()) {
            $parameter->setNullable($reflectionParameter->isOptional());
        }

        if (count($types) > 1 || $reflectionParameter->isVariadic()) {
            $parameter->setNullable(false);
        }

        if (!$reflectionParameter->isDefaultValueAvailable()) {
            return;
        }

        $defaultValue = $reflectionParameter->getDefaultValue();
        if (is_object($defaultValue)) {
            $parameter->setDefaultValue(null);
            $parameter->setNullable(true);

            return;
        }

        $parameter->setDefaultValue($defaultValue);
        $parameter->setNullable(false);
    }

    private function overwriteFile(string $content, string $basename): void
    {
        $srcDir = dirname(__DIR__, 2) . '/src';

        $SPDX = ' * SPDX';

        $finalContent = implode("\n\n", array_filter([
            '<?php',
            '/*',
            $SPDX . '-License-Identifier: MIT',
            $SPDX . '-FileCopyrightText: (c) Respect Project Contributors',
            '/*',
            'declare(strict_types=1);',
            preg_replace('/extends (.+, )+/', 'extends' . "\n" . '\1', $content),
        ]));

        file_put_contents(
            sprintf('%s/Mixins/%s.php', $srcDir, $basename),
            $finalContent,
        );
    }
}
