<?php
namespace Pribi\Commands\Openers;

use Pribi\Builders\CommandsBuilder;
use Pribi\Commands\Command;
use Pribi\Commands\Identifiers\Identifier;
use Pribi\Commands\Inserts\InsertIgnoreInto;
use Pribi\Commands\Inserts\InsertInto;
use Pribi\Commands\Selects\Select;
use Pribi\Commands\Identifiers\Identifiers;
use Pribi\Commands\Transactions\StartTransactions\StartTransaction;
use Pribi\Commands\Deletions\Delete;

class Query extends Command {
	public function __construct(CommandsBuilder $commandsBuilder) {
		parent::__construct($this, $commandsBuilder);
	}

	protected function toSql() {
		return '';
	}

	public function insertInto($table, $columns) {
		return $this->getCommandBuilder()->createInsertInto(
			$this->getCommandBuilder()->createIdentifier($table),
			$this,
			$this->getCommandBuilder()->createIdentifiers($columns)
		);
	}

	public function insertIgnoreInto($table, $columns) {
		return $this->getCommandBuilder()->createInsertIgnoreInto(
			$this->getCommandBuilder()->createIdentifier($table),
			$this,
			$this->getCommandBuilder()->createIdentifiers($columns)
		);
	}

	public function select($subject) {
		return $this->getCommandBuilder()->createSelect(
			$this->getCommandBuilder()->createIdentifier($subject),
			$this
		);
	}

	public function delete($subject) {
		return $this->getCommandBuilder()->createDelete(
			$this->getCommandBuilder()->createIdentifier($subject),
			$this
		);
	}

	public function startTransaction() {
		return new StartTransaction($this);
	}
}
