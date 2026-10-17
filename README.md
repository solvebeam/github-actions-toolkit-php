# GitHub Actions Toolkit PHP

**Write GitHub Actions in PHP — with the same building blocks as the official JavaScript toolkit.**

The [GitHub Actions Toolkit](https://github.com/actions/toolkit) is what GitHub itself uses to build actions in JavaScript and TypeScript. This library brings that same developer experience to PHP: read inputs, set outputs, fold log lines into groups, report errors, run commands and style your output — all with a small, familiar API.

- 🐘 **Pure PHP** — no Node.js, no build step, just PHP 8.3+.
- 📦 **Zero dependencies** — nothing to install besides this package.
- 🧭 **Familiar API** — modeled after [`@actions/core`](https://github.com/actions/toolkit/tree/main/packages/core) and [`@actions/exec`](https://github.com/actions/toolkit/tree/main/packages/exec), so the official docs and examples translate directly.
- 🔒 **Safe by default** — workflow command data is escaped, so messages with newlines or `%` characters can't break your log.
- ✅ **Strictly typed** — `declare(strict_types=1)`, final classes and analysed with PHPStan.

Already have PHP scripts in your workflows? Turn them into first-class actions with readable logs, clear errors and proper outputs.

## Toolkit at a glance

| Class | Inspired by | What it does |
| --- | --- | --- |
| [`Core`](psr-4/Core.php) | [`@actions/core`](https://github.com/actions/toolkit/tree/main/packages/core) | Inputs, outputs, errors, failing the action and log groups. |
| [`Shell`](psr-4/Shell.php) | [`@actions/exec`](https://github.com/actions/toolkit/tree/main/packages/exec) | Run commands with the command echoed in the log, optionally failing on a non-zero exit code. |
| [`Summary`](psr-4/Summary.php) | [`@actions/core` job summary](https://github.com/actions/toolkit/tree/main/packages/core#populating-job-summary) | Write Markdown to the job summary of the workflow run. |
| [`Style`](psr-4/Style.php) | [`@actions/core` styling](https://github.com/actions/toolkit/tree/main/packages/core#styling-output) | Bold, italic, underlined and colored output. |

## Requirements

- PHP 8.3+
- Composer

## Installation

```sh
composer require solvebeam/github-actions-toolkit-php
```

## Quick start

```php
use SolveBeam\GitHubActionsToolkit\Core;
use SolveBeam\GitHubActionsToolkit\Shell;

$core  = new Core();
$shell = new Shell();

$version = $core->get_required_input( 'version' );

$core->start_group( 'Install dependencies' );

try {
	$shell->must_run( 'composer install --no-dev' );
} catch ( RuntimeException $e ) {
	$core->set_failed( $e->getMessage() );
}

$core->end_group();

$core->set_output( 'version', $version );
```

## Usage

### Inputs and outputs

```php
use SolveBeam\GitHubActionsToolkit\Core;

$core = new Core();

// Returns the input value, or `false` if it is not set.
$name = $core->get_input( 'name' );

// Fails the action if the input is not supplied.
$token = $core->get_required_input( 'token' );

$core->set_output( 'result', 'success' );
```

### Log groups

```php
use SolveBeam\GitHubActionsToolkit\Core;

$core = new Core();

$core->start_group( 'Install dependencies' );

// Everything printed here is folded into a collapsible group in the log.

$core->end_group();
```

### Errors and failing the action

```php
use SolveBeam\GitHubActionsToolkit\Core;

$core = new Core();

// Adds an error annotation to the workflow run.
$core->error( 'Something went wrong.' );

// Adds an error annotation and exits with code 1.
$core->set_failed( 'Something went terribly wrong.' );
```

### Job summary

```php
use SolveBeam\GitHubActionsToolkit\Summary;

$summary = new Summary();

$summary
	->add_heading( 'Deploy to WordPress.org', 2 )
	->add_eol()
	->add_raw( '✅ Deployed.', true )
	->write();
```

Content is buffered until `write()` appends it to the file in `GITHUB_STEP_SUMMARY`. Headings are written as Markdown, so Markdown such as lists and tables can follow directly.

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

`run()` prints and executes the command and returns the result code. `must_run()` does the same, but throws a `RuntimeException` if the result code is not `0`. Commands are printed with the `[command]` prefix, which the GitHub Actions log viewer highlights, just like `@actions/exec` does.

## Development

```sh
composer install
composer run phpcs
composer run phpstan
composer run rector
```

## Credits

This library is inspired by — and follows the conventions of — the official [GitHub Actions Toolkit](https://github.com/actions/toolkit) by GitHub. It is not affiliated with or endorsed by GitHub.

Built by [SolveBeam](https://www.solvebeam.com/) and [Remco Tolsma](https://www.remcotolsma.nl/).

## License

MIT
