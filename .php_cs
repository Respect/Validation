<?php

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@PHP71Migration:risky' => true,
        'phpdoc_align' => false,
        'phpdoc_summary' => false,
        'mb_str_functions' => true,
        'no_multiline_whitespace_before_semicolons' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'ordered_imports' => true,
        'phpdoc_order' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_short_echo_tag' => true,
        'php_unit_construct' => true,
        'php_unit_dedicate_assert' => true,
        'php_unit_expectation' => true,
        'php_unit_mock' => true,
        'php_unit_namespaced' => true,
        'php_unit_ordered_covers' => true,
        'php_unit_set_up_tear_down_visibility' => true,
        'php_unit_test_annotation' => [
            'style' => 'annotation',
        ],
        'php_unit_test_case_static_method_calls' => ['call_type' => 'self'],
        'php_unit_test_class_requires_covers' => true,
    ])
    ->setCacheFile(
        sprintf(
            '%s/.php_cs.cache',
            getenv('TRAVIS') ? getenv('HOME').'/.php-cs-fixer' : __DIR__
        )
    )
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(['library', 'tests'])
            ->name('*.php')
            ->name('*.phpt')
    );
