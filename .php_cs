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
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(['library', 'tests'])
            ->name('*.php')
            ->name('*.phpt')
    );
