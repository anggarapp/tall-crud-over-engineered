<?php

namespace Tests\Feature;

use App\Services\PostService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\TestCase;

use function PHPUnit\Framework\assertInstanceOf;

class PostTest extends TestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    protected $seed = true;
    private PostService $postService;
    protected function setUp(): void
    {
        parent::setUp();
        $this->postService = $this->app->make(PostService::class);
    }
    /**
     * A basic feature test example.
     */

    public function testPostServiceNotNull(): void
    {
        self::assertNotNull($this->postService);
    }

    public function testSeederCreated(): void
    {
        $this->assertDatabaseHas('posts', ['id' => '1']);
        $this->assertDatabaseCount('posts', 10);
    }

    public function testGetAllPost(): void
    {
        $collection = $this->postService->getAllPosts();
        self::assertInstanceOf(Collection::class, $collection);
        $this->assertNotNull($collection->toQuery()->get());
    }
}
