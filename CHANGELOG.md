# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- `Core::start_group()` and `Core::end_group()` for grouping log lines.
- `Style::bold()`, `Style::italic()`, `Style::underlined()` and `Style::cyan()` for styling output.
- `Style::command()` for formatting commands in output.
- `Core::set_failed()` for failing the action with an error message.
- `Shell::run()` and `Shell::must_run()` for running commands.
- `Summary::add_raw()`, `Summary::add_eol()`, `Summary::add_heading()` and `Summary::write()` for writing a job summary.

[unreleased]: https://github.com/solvebeam/github-actions-toolkit-php
