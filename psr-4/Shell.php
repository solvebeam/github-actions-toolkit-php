<?php
/**
 * Shell
 *
 * @author    SolveBeam
 * @copyright 2026 SolveBeam
 * @license   MIT
 * @package   SolveBeam\GitHubActionsToolkit
 */

declare(strict_types=1);

namespace SolveBeam\GitHubActionsToolkit;

/**
 * Shell class
 */
final readonly class Shell {
	/**
	 * Construct shell.
	 *
	 * @param Style $style The style helper.
	 */
	public function __construct( private Style $style = new Style() ) {
	}

	/**
	 * Run a command, the command is printed before it is executed.
	 *
	 * @param string $command The command.
	 * @return int The result code of the command.
	 */
	public function run( string $command ): int {
		echo $this->style->command( $command ), \PHP_EOL;

		\passthru( $command, $result_code );

		return $result_code;
	}

	/**
	 * Run a command that must succeed.
	 *
	 * @param string $command The command.
	 * @return void
	 * @throws \RuntimeException If the result code of the command is not 0.
	 */
	public function must_run( string $command ): void {
		$result_code = $this->run( $command );

		if ( 0 !== $result_code ) {
			throw new \RuntimeException(
				\sprintf( "The command '%s' failed with exit code %d", $command, $result_code ),
				$result_code
			);
		}
	}
}
