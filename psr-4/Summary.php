<?php
/**
 * Summary
 *
 * @author    SolveBeam
 * @copyright 2026 SolveBeam
 * @license   MIT
 * @package   SolveBeam\GitHubActionsToolkit
 */

declare(strict_types=1);

namespace SolveBeam\GitHubActionsToolkit;

/**
 * Summary class
 *
 * @link https://github.com/actions/toolkit/tree/main/packages/core#populating-job-summary
 * @link https://docs.github.com/en/actions/reference/workflows-and-actions/workflow-commands#adding-a-job-summary
 */
final class Summary {
	/**
	 * Buffer.
	 *
	 * @var string
	 */
	private string $buffer = '';

	/**
	 * Add raw text to the summary buffer.
	 *
	 * @param string $text    The text.
	 * @param bool   $add_eol Append an end of line.
	 * @return self
	 */
	public function add_raw( string $text, bool $add_eol = false ): self {
		$this->buffer .= $text;

		if ( $add_eol ) {
			$this->add_eol();
		}

		return $this;
	}

	/**
	 * Add an end of line to the summary buffer.
	 *
	 * @return self
	 */
	public function add_eol(): self {
		return $this->add_raw( \PHP_EOL );
	}

	/**
	 * Add a Markdown heading to the summary buffer.
	 *
	 * @param string $text  The heading text.
	 * @param int    $level The heading level, 1 to 6.
	 * @return self
	 */
	public function add_heading( string $text, int $level = 1 ): self {
		return $this->add_raw( \str_repeat( '#', $level ) . ' ' . $text, true );
	}

	/**
	 * Write the summary buffer to the job summary file and empty the buffer.
	 *
	 * @return self
	 */
	public function write(): self {
		$file = \getenv( 'GITHUB_STEP_SUMMARY' );

		if ( false === $file || '' === $file ) {
			return $this;
		}

		\file_put_contents( $file, $this->buffer, \FILE_APPEND );

		$this->buffer = '';

		return $this;
	}
}
