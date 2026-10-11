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
		return "\e[1m" . $text . "\e[0m";
	}

	/**
	 * Make text italic.
	 *
	 * @param string $text The text.
	 * @return string
	 */
	public function italic( string $text ): string {
		return "\e[3m" . $text . "\e[0m";
	}

	/**
	 * Make text underlined.
	 *
	 * @param string $text The text.
	 * @return string
	 */
	public function underlined( string $text ): string {
		return "\e[4m" . $text . "\e[0m";
	}
}
