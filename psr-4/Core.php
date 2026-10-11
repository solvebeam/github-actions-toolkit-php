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
	 * Get input.
	 *
	 * @link https://docs.github.com/en/actions/creating-actions/metadata-syntax-for-github-actions#inputs
	 * @link https://docs.github.com/en/actions/using-workflows/workflow-syntax-for-github-actions#jobsjob_idstepswith
	 * @link https://github.com/actions/checkout/blob/cd7d8d697e10461458bc61a30d094dc601a8b017/dist/index.js#L2699-L2717
	 * @param string $name The name of the input.
	 * @return string|false
	 */
	public function get_input( string $name ): string|false {
		return \getenv( 'INPUT_' . \strtoupper( $name ) );
	}

	/**
	 * Get required input, exits with an error if the input is not supplied.
	 *
	 * @param string $name The name of the input.
	 * @return string
	 */
	public function get_required_input( string $name ): string {
		$value = $this->get_input( $name );

		if ( false === $value || '' === $value ) {
			echo '::error::', \str_replace( [ '%', "\r", "\n" ], [ '%25', '%0D', '%0A' ], 'Input required and not supplied: ' . $name ), \PHP_EOL;

			exit( 1 );
		}

		return $value;
	}

	/**
	 * Set output.
	 *
	 * @link https://docs.github.com/en/actions/writing-workflows/choosing-what-your-workflow-does/workflow-commands-for-github-actions#setting-an-output-parameter
	 * @param string $name  The name of the output.
	 * @param string $value The value of the output.
	 * @return void
	 */
	public function set_output( string $name, string $value ): void {
		$file = \getenv( 'GITHUB_OUTPUT' );

		if ( false === $file || '' === $file ) {
			return;
		}

		\file_put_contents( $file, $name . '=' . $value . \PHP_EOL, \FILE_APPEND );
	}

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
