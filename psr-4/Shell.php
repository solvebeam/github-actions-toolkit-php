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
	 * Run a command, the command is printed before it is executed.
	 *
	 * @param string $command The command.
	 * @return int The result code of the command.
	 */
	public function run( string $command ): int {
		$this->echo_command( $command );

		\passthru( $command, $result_code );

		return $result_code;
	}

	/**
	 * Echo a command, the `[command]` prefix is recognized by the GitHub Actions log viewer.
	 *
	 * @link https://github.com/actions/toolkit/blob/fa980c4100e53128102670562e9e293518900112/packages/exec/src/toolrunner.ts#L41-L81
	 * @link https://github.com/actions/toolkit/blob/fa980c4100e53128102670562e9e293518900112/packages/exec/src/toolrunner.ts#L420-L425
	 * @param string $command The command.
	 * @return void
	 */
	private function echo_command( string $command ): void {
		echo '[command]', $command, \PHP_EOL;
	}

	/**
	 * Skip a command, the command is printed but not executed.
	 *
	 * @param string $command The command.
	 * @return void
	 */
	public function skip( string $command ): void {
		$this->echo_command( $command );

		echo 'Skipped, command not executed.', \PHP_EOL;
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
