  <?php
    /*
    * Further information https://mlocati.github.io/php-cs-fixer-configurator/
    *
    * /!\ means risky
    */

    if (!file_exists(__DIR__.'/src')) {
    exit(0);
  }
    return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
    '@PhpCsFixer' => true,
    '@PhpCsFixer:risky' => true,
    '@Symfony' => true,
    '@Symfony:risky' => true,
    '@DoctrineAnnotation'=> true,
    '@PHP71Migration' => true,
    '@PHP71Migration:risky' => true,
    '@PHPUnit60Migration:risky' => true,
    'single_line_comment_style' => true, // @PhpCsFixer @Symfony
    'multiline_whitespace_before_semicolons' => true, // @PhpCsFixer
    'ordered_imports' => ['imports_order' => ['class', 'const', 'function' ]], // @PhpCsFixer
    'doctrine_annotation_array_assignment' => true, // @DoctrineAnnotation
    'doctrine_annotation_spaces' => true, // @DoctrineAnnotation
    'general_phpdoc_annotation_remove' => ['annotations' => ["author", "package"]], // none
    'simplified_null_return' => true, // none
    'date_time_immutable' => true, // none /!\
    'general_phpdoc_annotation_remove' => [], // none
    'linebreak_after_opening_tag' => true, // none
    'list_syntax' => ["syntax" => "short"], // none
    'return_assignment' => false,
    'native_function_invocation' => true,
    ])
    ->setFinder(
    PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src')
    )
;
