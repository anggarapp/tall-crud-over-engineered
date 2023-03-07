<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    protected $seed = true;
    private TagService $tagService;
    protected function setUp(): void
    {
        parent::setUp();
        $this->tagService = $this->app->make(TagService::class);
    }
    /**
     * A basic feature test example.
     */
    public function testTagServiceNotNull(): void
    {
        self::assertNotNull($this->tagService);
    }

    public function testSeederCreated(): void
    {
        $this->assertDatabaseHas('tags', ['id' => '1']);
        $this->assertDatabaseCount('tags', 3);
    }

    public function testGetAllTag(): void
    {
        $collection = $this->tagService->getAllTags();
        self::assertInstanceOf(Collection::class, $collection);
        $this->assertNotNull($collection->toQuery()->get());
    }

    public function testGetTagById(): void
    {

        $this->tagService->createTag([
            'name' => 'Tag By Id',
        ]);

        $this->assertDatabaseHas('tags', [
            'name' => 'Tag By Id',
        ]);

        $tag = Tag::where('name', 'Tag By Id')->first();
        $tagId = $tag->id;
        $tagFromService = $this->tagService->getTagById($tagId);
        $tagIdFromService = $tagFromService->id;
        $this->assertSame($tagId, $tagIdFromService);
    }

    public function testCreateTag(): void
    {
        $this->tagService->createTag([
            'name' => 'Tag Create',
        ]);

        $this->assertDatabaseHas('tags', [
            'name' => 'Tag Create',
        ]);
    }

    public function testUpdateTag(): void
    {
        $this->tagService->createTag([
            'name' => 'Tag Create',
        ]);

        $this->assertDatabaseHas('tags', [
            'name' => 'Tag Create',
        ]);

        $tagId = Tag::where('name', 'Tag Create')->first()->id;

        $this->tagService->updateTag($tagId, [
            'name' => 'Tag Update',

        ]);

        $this->assertDatabaseHas('tags', [
            'name' => 'Tag Update',

        ]);

        $this->assertDatabaseMissing('tags', [
            'name' => 'Tag Create',
        ]);
    }

    public function testDeleteTag(): void
    {
        $this->tagService->createTag([
            'name' => 'Tag Create'
        ]);

        $this->assertDatabaseHas('tags', [
            'name' => 'Tag Create'
        ]);

        $tagId = Tag::where('name', 'Tag Create')->first()->id;

        $this->tagService->deleteTag($tagId);

        $this->assertDatabaseMissing('tags', [
            'name' => 'Tag Create'
        ]);
    }
}
