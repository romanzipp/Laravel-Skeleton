<?php

namespace Tests\Unit\Support;

use Domain\User\Models\User;
use romanzipp\DTO\Exceptions\InvalidDataException;
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
        $this->expectException(InvalidDataException::class);

        new class extends AbstractData {

            protected static array $required = [
                'what',
            ];

            public bool $what;
        };
    }

    public function testRequiredMissing()
    {
        $this->expectException(InvalidDataException::class);

        new class extends AbstractData {

            protected static array $required = [
                'what',
            ];

            public bool $what;
        };
    }

    public function testRequiredDefaultValueMissing()
    {
        $this->expectException(InvalidDataException::class);

        new class extends AbstractData {

            protected static array $required = [
                'what',
            ];

            public bool $what = true;
        };
    }

    public function testRequiredFilled()
    {
        $data = new class(['what' => true]) extends AbstractData {

            protected static array $required = [
                'what',
            ];

            public bool $what;
        };

        $this->assertTrue($data->what);
    }
}
