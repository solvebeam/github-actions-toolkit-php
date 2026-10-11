<?php
/**
 * Style
 *
 * @author    SolveBeam
 * @copyright 2026 SolveBeam
 * @license   MIT
 * @package   SolveBeam\GitHubActionsToolkit
 */

declare(strict_types=1);

namespace SolveBeam\GitHubActionsToolkit;

/**
 * Style class
 *
 * @link https://github.com/actions/toolkit/tree/main/packages/core#styling-output
 */
final class Style {
	/**
	 * Make text bold.
	 *
	 * @param string $text The text.
	 * @return string
	 */
	public function bold( string $text ): string {
		return $this->escape_sequence( '1' ) . $text . $this->reset();
	}

	/**
	 * Make text italic.
	 *
	 * @param string $text The text.
	 * @return string
	 */
	public function italic( string $text ): string {
		return $this->escape_sequence( '3' ) . $text . $this->reset();
	}

	/**
	 * Make text underlined.
	 *
	 * @param string $text The text.
	 * @return string
	 */
	public function underlined( string $text ): string {
		return $this->escape_sequence( '4' ) . $text . $this->reset();
	}

	/**
	 * Make text cyan.
	 *
	 * @param string $text The text.
	 * @return string
	 */
	public function cyan( string $text ): string {
		return $this->escape_sequence( '36' ) . $text . $this->reset();
	}

	/**
	 * Format a command.
	 *
	 * @param string $command The command.
	 * @return string
	 */
	public function command( string $command ): string {
		return $this->cyan( $command );
	}

	/**
	 * Get the escape sequence for a code.
	 *
	 * @param string $code The code.
	 * @return string
	 */
	private function escape_sequence( string $code ): string {
		return "\e[" . $code . 'm';
	}

	/**
	 * Get the escape sequence to reset all styling.
	 *
	 * @return string
	 */
	private function reset(): string {
		return $this->escape_sequence( '0' );
	}
}
