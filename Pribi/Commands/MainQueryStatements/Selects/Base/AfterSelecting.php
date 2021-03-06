<?php
namespace Pribi\Commands\MainQueryStatements\Selects\Base;

trait AfterSelecting {

	/**
	 * @param $subject
	 * @return \Pribi\Commands\MainQueryStatements\Selects\Select
	 */
	public function select($subject) {
		/** @var \Pribi\Commands\Command $this */
		return $this->getCommandBuilder()->createMainQuerySelect(
			$this->getCommandBuilder()->createIdentifier($subject),
			$this
		);
	}

	/**
	 * @param $subject
	 * @return \Pribi\Commands\MainQueryStatements\FromDefinitions\From
	 */
	public function from($subject) {
		/** @var \Pribi\Commands\Command $this */
		return $this->getCommandBuilder()->createMainQueryFrom(
			$this->getCommandBuilder()->createIdentifier($subject),
			$this
		);
	}

	/**
	 * @param $subject
	 * @return \Pribi\Commands\MainQueryStatements\WhereConditions\Where
	 */
	public function where($subject) {
		/** @var \Pribi\Commands\Command $this */
		return $this->getCommandBuilder()->createMainQueryWhere(
			$this->getCommandBuilder()->createIdentifier($subject),
			$this
		);
	}

	/**
	 * @param $subject
	 * @return \Pribi\Commands\MainQueryStatements\WhereConditions\WhereNot
	 */
	public function whereNot($subject) {
		/** @var \Pribi\Commands\Command $this */
		return $this->getCommandBuilder()->createMainQueryWhereNot(
			$this->getCommandBuilder()->createIdentifier($subject),
			$this
		);
	}

	/**
	 * @param $limit
	 * @param int $offset
	 * @return \Pribi\Commands\MainQueryStatements\Limits\Limit
	 */
	public function limit($limit) {
		/** @var \Pribi\Commands\Command $this */
		return $this->getCommandBuilder()->createMainQueryLimit(0, $limit, $this);
	}

	/**
	 * @param $limit
	 * @param int $offset
	 * @return \Pribi\Commands\MainQueryStatements\Limits\Limit
	 */
	public function offsetLimit($offset, $limit) {
		/** @var \Pribi\Commands\Command $this */
		return $this->getCommandBuilder()->createMainQueryLimit($offset, $limit, $this);
	}

}
