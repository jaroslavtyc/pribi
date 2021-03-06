<?php
namespace Pribi\Commands\AnyQueryStatements\FromDefinitions;

/**
 * @method FromAlias as ($alias)
 */
class From extends \Pribi\Commands\IdentifierBringer implements Parts\FromLike {

	use \Pribi\Commands\AnyQueryStatements\Joins\Joining;
	use \Pribi\Commands\AnyQueryStatements\WhereConditions\Parts\Whereing;
	use \Pribi\Commands\AnyQueryStatements\Limits\Parts\Limiting;

	protected function toSql() {
		if (is_a($this->getPreviousCommand(), self::CLASS_IDENTITY)) {
			return ',' . $this->getIdentifier()->toSql();
		} else {
			return 'FROM ' . $this->getIdentifier()->toSql();
		}
	}

	protected function alias($aliasName) {
		return $this->getCommandBuilder()->createAnyQueryFromAlias(
			$this->getCommandBuilder()->createIdentifier($aliasName),
			$this
		);
	}
}
