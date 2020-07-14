<?php

namespace Tests\Unit\Support;

use Domain\User\Models\User;
use Spatie\DataTransferObject\DataTransferObjectError;
use Support\Data\AbstractData;
use Tests\TestCase;

class DataTest extends TestCase
{
    public function testBasicBoolsDefaults()
    {
        $data = new class extends AbstractData {
            public bool $yes = true;
            public bool $no = false;
        };

        $this->assertTrue($data->yes);
        $this->assertFalse($data->no);
    }

    public function testBasicBools()
    {
        $data = new class(['yes' => true, 'no' => false]) extends AbstractData {
            public bool $yes;
            public bool $no;
        };

        $this->assertTrue($data->yes);
        $this->assertFalse($data->no);
    }

    public function testTypeHintedUnintialized()
    {
        $data = new class extends AbstractData {
            public User $user;
        };

        $this->assertFalse(property_set($data, 'user'));
    }

    public function testTypeHintedNullable()
    {
        $data = new class extends AbstractData {
            public ?User $user;
        };

        $this->assertFalse(property_set($data, 'user'));
    }

    public function testTypeHintedNull()
    {
        $data = new class extends AbstractData {
            public ?User $user = null;
        };

        $this->assertTrue(property_set($data, 'user'));
    }

    public function testDocBlockRequiredMissing()
    {
        $this->expectException(DataTransferObjectError::class);

        new class extends AbstractData {
            /** @required */
            public bool $what;
        };
    }

    public function testRequiredMissing()
    {
        $this->expectException(DataTransferObjectError::class);

        new class extends AbstractData {
            /** @required */
            public bool $what;
        };
    }

    public function testRequiredDefaultValueMissing()
    {
        $this->expectException(DataTransferObjectError::class);

        new class extends AbstractData {
            /** @required */
            public bool $what = true;
        };
    }

    public function testRequiredNullValueMissing()
    {
        $this->expectException(DataTransferObjectError::class);

        new class extends AbstractData {
            /** @required */
            public ?string $what = null;
        };
    }

    public function testRequiredFilled()
    {
        $data = new class(['what' => true]) extends AbstractData {
            /** @required */
            public bool $what;
        };

        $this->assertTrue($data->what);
    }
}
