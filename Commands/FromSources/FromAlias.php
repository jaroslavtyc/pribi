<?php
namespace Pribi\Commands\FromSources;

use Pribi\Commands\IdentifierAlias,
	Pribi\Commands\Joins\InnerJoin,
	Pribi\Commands\Joins\LeftJoin,
	Pribi\Commands\Joins\RightJoin,
	Pribi\Commands\Where,
	Pribi\Commands\Limit;

class FromAlias extends IdentifierAlias {
	public function innerJoin($identificator) {
		return new InnerJoin($identificator, $this);
	}

	public function leftJoin($identificator) {
		return new LeftJoin($identificator, $this);
	}

	public function rightJoin($identificator) {
		return new RightJoin($identificator, $this);
	}

	public function where($identificator) {
		return new Where($identificator, $this);
	}

	public function limit($limit) {
		return new Limit(0, $limit);
	}

	public function offsetLimit($offset, $limit) {
		return new Limit($offset, $limit);
	}
}
