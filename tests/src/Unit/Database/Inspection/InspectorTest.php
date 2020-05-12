<?php

declare(strict_types=1);

namespace Directus\Tests\Unit\Database\Inspection;

use Directus\Contracts\Database\Inspection\Inspector as InspectorContract;
use Directus\Testing\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @covers \Directus\Database\Inspection\Column
 * @covers \Directus\Database\Inspection\Inspector
 * @covers \Directus\Database\Inspection\Table
 *
 * @internal
 */
final class InspectorTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var InspectorContract
     */
    private $inspector;

    protected function setUp(): void
    {
        parent::setUp();
        $this->inspector = directus()->databases()->database()->inspector();
    }

    public function testFindTable(): void
    {
        $posts = $this->inspector->table('posts');

        static::assertEquals('posts', $posts->name());
    }

    public function testFindColumn(): void
    {
        $id = $this->inspector->table('posts')->column('id');
        $id2 = $this->inspector->column('posts', 'id');

        static::assertEquals($id->name(), $id2->name());

        static::assertEquals('id', $id->name());
        static::assertTrue($id->primary());
    }

    public function testListColumns(): void
    {
        $columns = $this->inspector->table('posts')->columns();
        $names = $columns->map(static function ($column): string {
            return $column->name();
        });

        static::assertEquals([
            'id', 'author_id', 'title', 'content', 'published', 'edited', 'views',
        ], $names->all());
    }

    public function testColumnProperties(): void
    {
        $table = $this->inspector->table('posts');

        $id = $table->column('id');
        static::assertEquals('id', $id->name());
        static::assertEquals('integer', $id->type());
        static::assertTrue($id->primary());
        static::assertTrue($id->unique());

        $title = $table->column('title');
        static::assertEquals('title', $title->name());
        static::assertEquals('string', $title->type());
        static::assertFalse($title->primary());
        static::assertFalse($title->unique());

        $content = $table->column('content');
        static::assertEquals('content', $content->name());
        static::assertEquals('text', $content->type());
        static::assertFalse($content->primary());
        static::assertFalse($content->unique());

        $views = $table->column('views');
        static::assertEquals('views', $views->name());
        static::assertEquals('integer', $views->type());
    }
}
