<?php
namespace Pribi\Commands\Transactions\Commits;
use Pribi\Commands\FollowingCommand;
use Pribi\Commands\Transactions\Rollbacks\Rollback;

class Release extends FollowingCommand {
	public function rollback() {
		$rollback = new Rollback($this);

		return $rollback;
	}
}
