<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

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
            'content' => 'Post By Id Test Case',
            // 'tags' => [],
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
            'content' => 'Post Create Test Case',
            // 'tags' => [],
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
            'content' => 'Post Update Test Case',
            // 'tags' => [],
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'Post Create',
            'content' => 'Post Update Test Case'
        ]);

        $postId = Post::where('title', 'Post Create')->first()->id;

        $this->postService->updatePost($postId, [
            'title' => 'Post Update',
            'content' => 'Post Updated Test Case',
            // 'tags' => [],
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
            'content' => 'Post Delete Test Case',
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

    public function testFindWithSortation()
    {
        $posts = $this->postService->findPostWithSort('id', 'asc')->first();
        assertNotNull($posts);
        assertEquals('1', $posts->id);
        $posts = $this->postService->findPostWithSort('id', 'desc')->first();
        assertNotNull($posts);
        assertEquals('10', $posts->id);
    }

    public function testCreatePostWithTags()
    {
        $this->postService->createPost([
            'title' => 'Post Create',
            'content' => 'Post Delete Test Case',
            'tags' => ['test', 'toast']
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'Post Create',
            'content' => 'Post Delete Test Case'
        ]);
        $this->assertDatabaseHas('tags', [
            'name' => 'test',
        ]);
        $this->assertDatabaseHas('tags', [
            'name' => 'toast',
        ]);
    }

    
}
