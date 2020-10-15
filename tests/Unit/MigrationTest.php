<?php

namespace Tests\Unit;

use Illuminate\Contracts\Console\Kernel;
use Tests\TestCase;

class MigrationTest extends TestCase
{
    public function testMigrate()
    {
        foreach ($this->getMigrations() as $migration) {
            $this->artisan('migrate --step');
        }

        $this->app[Kernel::class]->setArtisan(null);

        self::assertTrue(true);
    }

    public function testMigrateRollback()
    {
        foreach ($this->getMigrations() as $migration) {
            $this->artisan('migrate --step');
        }

        foreach ($this->getMigrations() as $migration) {
            $this->artisan('migrate:rollback');
        }

        $this->app[Kernel::class]->setArtisan(null);

        self::assertTrue(true);
    }

    private function getMigrations(): array
    {
        return array_values(
            array_diff(
                scandir(
                    database_path('migrations')
                ),
                ['..', '.', '.gitignore']
            )
        );
    }
}
