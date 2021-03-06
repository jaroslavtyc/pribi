<?php
namespace Pribi\Commands\AnyQueryStatements\Inserts;

/**
 * Class Insert
 * @package Pribi\Commands\AnyQueryStatements\Inserts
 *
 * @see http://dev.mysql.com/doc/refman/5.6/en/insert.html
 */
class Insert extends \Pribi\Commands\WithoutIdentifier {

	protected function toSql() {
		return 'INSERT';
	}

	public function lowPriority() {
		return $this->getCommandBuilder()->createLowPriority($this);
	}

	public function highPriority() {
		return $this->getCommandBuilder()->createHighPriority($this);
	}

	public function delayed() {
		return $this->getCommandBuilder()->createDelayed($this);
	}

	public function ignore() {
		return $this->getCommandBuilder()->createIgnore($this);
	}

	public function into($tableName, array $columnNames = [], array $partitionNames = []) {
		return $this->getCommandBuilder()->createInto(
			$this->getCommandBuilder()->createIdentifier($tableName),
			$this->getCommandBuilder()->createIdentifiers($columnNames),
			$this->getCommandBuilder()->createIdentifiers($partitionNames),
			$this
		);
	}

}
