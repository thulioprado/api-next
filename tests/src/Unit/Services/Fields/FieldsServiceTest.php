<?php

declare(strict_types=1);

namespace Directus\Tests\Unit\Services\Fields;

use Directus\Services\Fields\FieldsService;
use Directus\Testing\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @covers \Directus\Services\Fields\FieldsService
 *
 * @internal
 */
final class FieldsServiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var FieldsService
     */
    private $fields;

    protected function setUp(): void
    {
        parent::setUp();

        $this->fields = directus()->fields();
    }

    public function testPlaceholder(): void
    {
        $a = 0 + 1;
        static::assertSame(1, $a);
    }
}
