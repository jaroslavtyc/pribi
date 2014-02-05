<?php
namespace Pribi\Commands\Selects;

use Pribi\Executions\Executable,
	Pribi\Executions\Executabling,
	Pribi\Commands\FromSources\From,
	Pribi\Commands\Identifiers\Identifier,
	Pribi\Commands\Identifiers\IdentifierAlias;

class SelectAlias extends IdentifierAlias implements Executable, SelectIdentity {
	use Executabling;

	public function __construct(Identifier $alias, Select $prependSelect) {
		parent::__construct($alias, $prependSelect);
	}

	protected function toSql() {
		return 'AS ' . $this->getIdentifier()->toSql();
	}

	public function select($identificator) {
		return new Select($identificator, $this);
	}

	public function from($name) {
		return new From(new Identifier($name), $this);
	}

	public function where($identificator) {
		return new Where($identificator, $this);
	}

	public function limit($amount) {
		return new Limit(0, $amount, $this);
	}

	public function offsetLimit($offset, $limit) {
		return new Limit($offset, $limit, $this);
	}
}
