<?php

namespace Tests\Feature;

use App\Models\Post;
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

    public function testGetPostById(): void
    {

        $this->postService->createPost([
            'title' => 'Post By Id',
            'content' => 'Post By Id Test Case'
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'Post By Id',
            'content' => 'Post By Id Test Case'
        ]);

        $post = Post::where('title', 'Post By Id')->first();
        $postId = $post->id;
        $postFromService = $this->postService->getPostById($postId);
        $postIdFromService = $postFromService->id;
        $this->assertSame($postId, $postIdFromService);
    }

    public function testCreatePost(): void
    {
        $this->postService->createPost([
            'title' => 'Post Create',
            'content' => 'Post Create Test Case'
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'Post Create',
            'content' => 'Post Create Test Case'
        ]);
    }

    public function testUpdatePost(): void
    {
        $this->postService->createPost([
            'title' => 'Post Create',
            'content' => 'Post Update Test Case'
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'Post Create',
            'content' => 'Post Update Test Case'
        ]);

        $postId = Post::where('title', 'Post Create')->first()->id;

        $this->postService->updatePost($postId, [
            'title' => 'Post Update',
            'content' => 'Post Updated Test Case'
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'Post Update',
            'content' => 'Post Updated Test Case'
        ]);

        $this->assertDatabaseMissing('posts', [
            'title' => 'Post Create',
            'content' => 'Post Update Test Case'
        ]);
    }

    public function testDeletePost(): void
    {
        $this->postService->createPost([
            'title' => 'Post Create',
            'content' => 'Post Delete Test Case'
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'Post Create',
            'content' => 'Post Delete Test Case'
        ]);

        $postId = Post::where('title', 'Post Create')->first()->id;

        $this->postService->deletePost($postId);

        $this->assertDatabaseMissing('posts', [
            'title' => 'Post Create',
            'content' => 'Post Delete Test Case'
        ]);
    }
}
