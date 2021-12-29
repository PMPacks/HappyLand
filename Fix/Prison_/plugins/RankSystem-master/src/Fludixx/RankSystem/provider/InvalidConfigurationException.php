<?php

/**
 * RankSystem - InvalidConfigurationException.php
 * @author Fludixx
 */

declare(strict_types=1);

namespace Fludixx\RankSystem\provider;

use Throwable;

class InvalidConfigurationException extends \Exception {

	public function __construct(string $message = "", int $code = 0, Throwable $previous = NULL)
	{
		parent::__construct($message, $code, $previous);
	}

	public function __toString()
	{
		return "Found Errors in Configuration File: {$this->getMessage()}";
	}

}