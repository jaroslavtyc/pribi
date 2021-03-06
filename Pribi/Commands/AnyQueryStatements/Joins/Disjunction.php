<?php
namespace Pribi\Commands\Joins;

use Pribi\Commands\Identifiers\Identifier;
use Pribi\Commands\Joins\Parts\AndOring;
use Pribi\Commands\Joins\Parts\Comparing;
use Pribi\Commands\AnyQueryStatements\Limits\Parts\Limitable;
use Pribi\Commands\AnyQueryStatements\Limits\Parts\Limiting;

class Disjunction extends \Pribi\Commands\AnyQueryStatements\Conditions\Disjunction implements Limitable {
	use AndOring;
	use Comparing;
	use Limiting;

	protected function conjunction(Identifier $identifier) {
		$conjunction = new Conjunction($identifier, $this);

		return $conjunction;
	}

	protected function disjunction(Identifier $identifier) {
		$disjunction = new Disjunction($identifier, $this);

		return $disjunction;
	}
}
