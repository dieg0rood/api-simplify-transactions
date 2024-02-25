<?php

declare(strict_types=1);

namespace HyperfTest\Cases;

use App\Database\Schema;
use Hyperf\DbConnection\Db;
use Hyperf\Testing\TestCase;

/**
 * @internal
 * @coversNothing
 */
class AbstractTest extends TestCase
{
    public function setUp(): void
    {
        Schema::disableForeignKeyConstraints();
        $table = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        foreach ($table as $name) {
            if ($name == 'migrations') {
                continue;
            }
            Db::table($name)->truncate();
        }
        Schema::enableForeignKeyConstraints();
    }
}
