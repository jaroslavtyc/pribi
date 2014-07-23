<?php
namespace Pribi\Commands\Openers;

class QueryTest extends \Tests\Helpers\TestCase {

	public function testInstanceCanBeCreated() {
		$instance = new Query($this->getCommandsBuilderDummy());
		$this->assertNotNull($instance);
	}

	public function testAsSqlIsEmptyString() {
		$toSqlMethod = new \ReflectionMethod(Query::class, 'toSql');
		$toSqlMethod->setAccessible(TRUE);
		$this->assertSame('', $toSqlMethod->invoke(new Query($this->getCommandsBuilderDummy())));
	}

	public function testCanInsertInto() {
		$commandsBuilderMock = $this->getMock(\Pribi\Builders\CommandsBuilder::class);
		$query = $this->createQuery($commandsBuilderMock);
		$createdStatementDummy = 'foo';
		$commandsBuilderMock
			->expects($this->once())
			->method('createInsertInto')
			->willReturn($createdStatementDummy);
		$tableName = 'bar';
		$commandsBuilderMock
			->expects($this->once())
			->method('createIdentifier')
			->with($tableName)
			->willReturn($this->getMockBuilder(\Pribi\Commands\Identifiers\Identifier::class)
					->disableOriginalConstructor()
					->getMock()
			);
		$columnNames = ['baz', 'qux'];
		$commandsBuilderMock
			->expects($this->once())
			->method('createIdentifiers')
			->with($columnNames)
			->willReturn($this->getMockBuilder(\Pribi\Commands\Identifiers\Identifiers::class)
					->disableOriginalConstructor()
					->getMock()
			);
		$this->assertSame($createdStatementDummy, $query->insertInto($tableName, $columnNames));
	}

	private function createQuery(\Pribi\Builders\CommandsBuilder $commandsBuilder) {
		return new Query($commandsBuilder);
	}

	public function testCanInsertIgnoreInto() {
		$commandsBuilderMock = $this->getMock(\Pribi\Builders\CommandsBuilder::class);
		$query = $this->createQuery($commandsBuilderMock);
		$createdStatementDummy = 'foo';
		$commandsBuilderMock
			->expects($this->once())
			->method('createInsertIgnoreInto')
			->willReturn($createdStatementDummy);
		$tableName = 'bar';
		$commandsBuilderMock
			->expects($this->once())
			->method('createIdentifier')
			->with($tableName)
			->willReturn($this->getMockBuilder(\Pribi\Commands\Identifiers\Identifier::class)
					->disableOriginalConstructor()
					->getMock()
			);
		$columnNames = ['baz', 'qux'];
		$commandsBuilderMock
			->expects($this->once())
			->method('createIdentifiers')
			->with($columnNames)
			->willReturn($this->getMockBuilder(\Pribi\Commands\Identifiers\Identifiers::class)
					->disableOriginalConstructor()
					->getMock()
			);
		$this->assertSame($createdStatementDummy, $query->insertIgnoreInto($tableName, $columnNames));
	}

	public function testCanSelect() {
		$commandsBuilderMock = $this->getMock(\Pribi\Builders\CommandsBuilder::class);
		$query = $this->createQuery($commandsBuilderMock);
		$createdStatementDummy = 'foo';
		$commandsBuilderMock
			->expects($this->once())
			->method('createMainQuerySelect')
			->willReturn($createdStatementDummy);
		$subject = 'bar';
		$commandsBuilderMock
			->expects($this->once())
			->method('createIdentifier')
			->with($subject)
			->willReturn($this->getMockBuilder(\Pribi\Commands\Identifiers\Identifier::class)
					->disableOriginalConstructor()
					->getMock()
			);
		$this->assertSame($createdStatementDummy, $query->select($subject));
	}

	public function testCanDelete() {
		$commandsBuilderMock = $this->getMock(\Pribi\Builders\CommandsBuilder::class);
		$query = $this->createQuery($commandsBuilderMock);
		$createdStatementDummy = 'foo';
		$commandsBuilderMock
			->expects($this->once())
			->method('createDelete')
			->willReturn($createdStatementDummy);
		$subject = 'bar';
		$commandsBuilderMock
			->expects($this->once())
			->method('createIdentifier')
			->with($subject)
			->willReturn($this->getMockBuilder(\Pribi\Commands\Identifiers\Identifier::class)
					->disableOriginalConstructor()
					->getMock()
			);
		$this->assertSame($createdStatementDummy, $query->delete($subject));
	}

	public function testCanStartTransaction() {
		$commandsBuilderMock = $this->getMock(\Pribi\Builders\CommandsBuilder::class);
		$query = $this->createQuery($commandsBuilderMock);
		$commandsBuilderMock
			->expects($this->once())
			->method('createMainQueryStartTransaction')
			->willReturn($this->getMockBuilder(\Pribi\Commands\Statements\Inserts\InsertInto::class)
					->disableOriginalConstructor()
					->getMock()
			);
		$query->startTransaction();
	}

	public function testCanBegin() {
		$commandsBuilderMock = $this->getMock(\Pribi\Builders\CommandsBuilder::class);
		$query = $this->createQuery($commandsBuilderMock);
		$createdStatementDummy = 'foo';
		$commandsBuilderMock
			->expects($this->once())
			->method('createMainQueryBegin')
			->willReturn($createdStatementDummy);
		$this->assertSame($createdStatementDummy, $query->begin());
	}

	public function testCanBeginWork() {
		$commandsBuilderMock = $this->getMock(\Pribi\Builders\CommandsBuilder::class);
		$query = $this->createQuery($commandsBuilderMock);
		$createdStatementDummy = 'foo';
		$commandsBuilderMock
			->expects($this->once())
			->method('createMainQueryBeginWork')
			->willReturn($createdStatementDummy);
		$this->assertSame($createdStatementDummy, $query->beginWork());
	}

	public function testCanCommit() {
		$commandsBuilderMock = $this->getMock(\Pribi\Builders\CommandsBuilder::class);
		$query = $this->createQuery($commandsBuilderMock);
		$createdStatementDummy = 'foo';
		$commandsBuilderMock
			->expects($this->once())
			->method('createMainQueryCommit')
			->willReturn($createdStatementDummy);
		$this->assertSame($createdStatementDummy, $query->commit());
	}

	public function testCanCommitWork() {
		$commandsBuilderMock = $this->getMock(\Pribi\Builders\CommandsBuilder::class);
		$query = $this->createQuery($commandsBuilderMock);
		$createdStatementDummy = 'foo';
		$commandsBuilderMock
			->expects($this->once())
			->method('createMainQueryCommitWork')
			->willReturn($createdStatementDummy);
		$this->assertSame($createdStatementDummy, $query->commitWork());
	}

	public function testCanDisableAutocommit() {
		$commandsBuilderMock = $this->getMock(\Pribi\Builders\CommandsBuilder::class);
		$query = $this->createQuery($commandsBuilderMock);
		$createdStatementDummy = 'foo';
		$commandsBuilderMock
			->expects($this->once())
			->method('createMainQueryDisableAutocommit')
			->willReturn($createdStatementDummy);
		$this->assertSame($createdStatementDummy, $query->disableAutocommit());
	}

	public function testCanEnableAutocommit() {
		$commandsBuilderMock = $this->getMock(\Pribi\Builders\CommandsBuilder::class);
		$query = $this->createQuery($commandsBuilderMock);
		$createdStatementDummy = 'foo';
		$commandsBuilderMock
			->expects($this->once())
			->method('createMainQueryEnableAutocommit')
			->willReturn($createdStatementDummy);
		$this->assertSame($createdStatementDummy, $query->enableAutocommit());
	}

	public function testCanRollback() {
		$commandsBuilderMock = $this->getMock(\Pribi\Builders\CommandsBuilder::class);
		$query = $this->createQuery($commandsBuilderMock);
		$createdStatementDummy = 'foo';
		$commandsBuilderMock
			->expects($this->once())
			->method('createMainQueryRollback')
			->willReturn($createdStatementDummy);
		$this->assertSame($createdStatementDummy, $query->rollback());
	}

	public function testCanRollbackWork() {
		$commandsBuilderMock = $this->getMock(\Pribi\Builders\CommandsBuilder::class);
		$query = $this->createQuery($commandsBuilderMock);
		$createdStatementDummy = 'foo';
		$commandsBuilderMock
			->expects($this->once())
			->method('createMainQueryRollbackWork')
			->willReturn($createdStatementDummy);
		$this->assertSame($createdStatementDummy, $query->rollbackWork());
	}
}
