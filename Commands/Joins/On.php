<?php
namespace Pribi\Commands\Joins;

use Pribi\Commands\Conditions\AndOrUsable;
use Pribi\Commands\Conditions\Comparable;
use Pribi\Commands\Conditions\Limitable;
use Pribi\Commands\Conditions\Limiting;
use Pribi\Commands\Disjunction;
use Pribi\Commands\EqualTo;
use Pribi\Commands\Negation;
use Pribi\Commands\RightJoin;
use Pribi\Commands\WhereSources\Whereable;
use Pribi\Commands\WhereSources\Whereing;
use Pribi\Commands\WithIdentifier;

class On extends WithIdentifier implements AndOrUsable, Comparable, Whereable, Limitable {
	use AndOring;
	use Comparing;
	use Whereing;
	use Limiting;

	protected function toSql() {
		return 'ON ' . $this->getIdentifier()->toSql();
	}
}
