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
```

## Development

```sh
composer install
composer run phpcs
composer run phpstan
composer run rector
```

## License

MIT
