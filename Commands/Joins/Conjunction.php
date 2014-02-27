<?php
namespace Pribi\Commands\Joins;

use Pribi\Commands\Conditions\Comparable;
use Pribi\Commands\Conditions\Limiting;
use Pribi\Commands\Conditions\Whereable;
use Pribi\Commands\Conditions\Whereing;
use Pribi\Commands\DifferentTo;
use Pribi\Commands\Identifiers\Identifier;
use Pribi\Commands\Conditions\Limitable;

class Conjunction extends \Pribi\Commands\Conditions\Conjunction implements Comparable, Whereable, Limitable {
	use AndOring;
	use Comparing;
	use Whereing;
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
