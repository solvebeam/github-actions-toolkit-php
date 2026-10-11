<?php
/**
 * Core
 *
 * @author    SolveBeam
 * @copyright 2026 SolveBeam
 * @license   MIT
 * @package   SolveBeam\GitHubActionsToolkit
 */

declare(strict_types=1);

namespace SolveBeam\GitHubActionsToolkit;

/**
 * Core class
 *
 * @link https://github.com/actions/toolkit/tree/main/packages/core
 */
final class Core {
	/**
	 * Begin an output group, output until the next `end_group` will be foldable in the log.
	 *
	 * @link https://docs.github.com/en/actions/reference/workflows-and-actions/workflow-commands#grouping-log-lines
	 * @param string $name The name of the output group.
	 * @return void
	 */
	public function start_group( string $name ): void {
		echo '::group::', \str_replace( [ '%', "\r", "\n" ], [ '%25', '%0D', '%0A' ], $name ), \PHP_EOL;
	}

	/**
	 * End an output group.
	 *
	 * @return void
	 */
	public function end_group(): void {
		echo '::endgroup::', \PHP_EOL;
	}
}
