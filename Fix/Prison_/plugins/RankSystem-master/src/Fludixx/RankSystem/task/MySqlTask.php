<?php

/**
 * RankSystem - MySqlTask.php
 * @author Fludixx
 */

declare(strict_types=1);

namespace Fludixx\RankSystem\task;

use Fludixx\RankSystem\RankSystem;
use pocketmine\network\mcpe\handler\NullSessionHandler;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

class MySqlTask extends AsyncTask {

	/**
	 * @var string   $query
	 * @var string[] $login
	 * @var int      $callback
	 */
	protected $query, $login, $callback, $extra, $result;

	public function __construct(string $query, array $login, int $callback = NULL, $extra = NULL)
	{
		$this->query = $query;
		$this->login = $login;
		$this->callback = $callback;
		if($extra !== NULL)
			$this->extra = $extra;
	}

	public function onRun()
	{
		$conn = new \mysqli($this->login['host'], $this->login['user'], $this->login['pass'], $this->login['db']);
		$result = $conn->query($this->query);
		if($result instanceof \mysqli_result and $this->callback !== NULL and $this->extra !== NULL) {
			switch ($this->callback) {
				case RankSystem::ACTION_LOGIN_PLAYER:
					$data = mysqli_fetch_array($result);
					echo "fes89uf8zrehfz\n";
					$this->setResult(['player' => $this->extra,
						'rank' => $data['playerRank'], 'nick' => $data['playerNick'] == 'null' ? NULL : $data['playerNick']]);
					var_dump($this->result);
					break;
			}
		}
	}

	public function onCompletion(Server $server)
	{
		if($this->callback !== NULL and $this->getResult() !== NULL) {
			RankSystem::callback($this->getResult(), $this->callback);
}
	}

}