<?php

/**
 * RankSystem - Rank.php
 * @author Fludixx
 */

declare(strict_types=1);

namespace Fludixx\RankSystem;

class Rank {

	/** @var string */
	public $name;
	/** @var string */
	public $chatformat;
	/** @var string */
	public $nametag;
	/** @var string[] */
	public $permissions;
	/** @var boolean */
	public $isDefault;

	/**
	 * Rank constructor.
	 * @param string $name
	 * @param array  $permissions
	 * @param string $chatformat
	 * @param string $nametag
	 * @param bool   $isDefault
	 */
	public function __construct(string $name, string $chatformat, string $nametag, array $permissions, bool $isDefault)
	{
		$this->load($name, $chatformat, $nametag, $permissions, $isDefault);
	}

	/**
	 * @return string
	 */
	public function getName() : string
	{
		return $this->name;
	}

	/**
	 * @return string[]
	 */
	public function getPermissions() : array
	{
		return $this->permissions;
	}

	/**
	 * @return string
	 */
	public function getChatformat() : string
	{
		return $this->chatformat;
	}

	/**
	 * @return string
	 */
	public function getNametag() : string
	{
		return $this->nametag;
	}

	/**
	 * @param string $name
	 * @param string $chatformat
	 * @param string $nametag
	 * @param array  $permissions
	 * @param bool   $isDefault
	 */
	public function load(string $name, string $chatformat, string $nametag, array $permissions, bool $isDefault) {
		$this->name = $name;
		$this->chatformat = $chatformat;
		$this->nametag = $nametag;
		$this->permissions = $permissions;
		$this->isDefault = $isDefault;
	}

}