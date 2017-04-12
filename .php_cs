<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->files()
    ->name('*.php')
    ->name('*.phpt')
    ->in('library')
    ->in('tests');

return Symfony\CS\Config\Config::create()
    ->level(\Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->fixers(array(
        'empty_return',
        'mb_str_functions',
        'multiline_spaces_before_semicolon',
        'newline_after_open_tag',
        'no_useless_else',
        'no_useless_return',
        'ordered_use',
        'phpdoc_order',
        'short_array_syntax',
    ))
    ->setUsingCache(true)
    ->finder($finder);
