<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

use Directus\Testing\TestCase;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @covers \Directus\Controllers\ActivityController
 *
 * @internal
 */
final class ActivityControllerTest extends TestCase
{
    use DatabaseTransactions;
    use ArraySubsetAsserts;

    /**
     * @var array
     */
    private $activity;

    /**
     * @var array
     */
    private $comment;

    protected function setUp(): void
    {
        $this->markTestSkipped();

        /*parent::setUp();

        $this->activity = directus()->activities()->create('created', 'posts', [
            'id' => 'some-user',
        ]);
        unset($this->activity['collection']);

        $this->comment = directus()->activities()->comment(
            'My comment lives here.',
            'posts',
            [
                'id' => 'random',
            ]
        );
        unset($this->comment['collection']);*/
    }

    public function testListAll(): void
    {
        $activities = $this->getJson('/directus/activity')->assertResponse()->data();
        static::assertCount(2, $activities);
        static::assertEquals([$this->activity, $this->comment], $activities);
    }

    public function testFetch(): void
    {
        $activity = $this->getJson("/directus/activity/{$this->activity['id']}")->assertResponse()->data();

        static::assertSame([
            'id' => 'some-user',
        ], $activity['item']);
    }

    public function testCreateComment(): void
    {
        $activity = $this->postJson('/directus/activity/comment', [
            'collection' => 'posts',
            'item' => [
                'id' => 'wow',
            ],
            'comment' => 'Hello world!',
        ])->data();

        static::assertArraySubset([
            'comment' => 'Hello world!',
            'comment_deleted_on' => null,
        ], $activity);
    }

    public function testUpdateComment(): void
    {
        $activity = $this->patchJson("/directus/activity/comment/{$this->comment['id']}", [
            'comment' => 'My new comment!',
        ])->data();

        static::assertArraySubset([
            'comment' => 'My new comment!',
        ], $activity);

        static::assertDatabaseHas('directus_activities', [
            'comment' => 'My new comment!',
        ]);
    }

    public function testUpdateCommentShouldFailIfNotComment(): void
    {
        $this->patchJson("/directus/activity/comment/{$this->activity['id']}", [
            'comment' => 'My new comment!',
        ]);
    }
}
