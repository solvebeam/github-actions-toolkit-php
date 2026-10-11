# GitHub Actions Toolkit PHP

PHP toolkit for developing GitHub Actions, inspired by the [GitHub Actions Toolkit](https://github.com/actions/toolkit).

## Requirements

- PHP 8.3+
- Composer

## Installation

```sh
composer require solvebeam/github-actions-toolkit-php
```

## Usage

```php
use SolveBeam\GitHubActionsToolkit\Core;

$core = new Core();

$core->start_group( 'Install dependencies' );

// …

$core->end_group();
```

### Styling output

```php
use SolveBeam\GitHubActionsToolkit\Style;

$style = new Style();

echo $style->bold( 'Bold' ), PHP_EOL;
echo $style->italic( 'Italic' ), PHP_EOL;
echo $style->underlined( 'Underlined' ), PHP_EOL;
echo $style->cyan( 'Cyan' ), PHP_EOL;
echo $style->command( 'composer install' ), PHP_EOL;
```

### Running commands

```php
use SolveBeam\GitHubActionsToolkit\Core;
use SolveBeam\GitHubActionsToolkit\Shell;

$core  = new Core();
$shell = new Shell();

try {
	$shell->must_run( 'composer install --no-dev' );

	$has_changes = 0 !== $shell->run( 'git diff --quiet' );
} catch ( RuntimeException $e ) {
	$core->set_failed( $e->getMessage() );
}
```

`run()` prints and executes the command and returns the result code. `must_run()` does the same, but throws a `RuntimeException` if the result code is not `0`.

## Development

```sh
composer install
composer run phpcs
composer run phpstan
composer run rector
```

## License

MIT
