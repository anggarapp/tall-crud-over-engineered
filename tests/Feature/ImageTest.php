<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\TestCase;

class ImageTest extends TestCase
{

    use RefreshDatabase;
    use CreatesApplication;

    protected $seed = true;
    private ImageService $imageService;
    protected function setUp(): void
    {
        parent::setUp();
        $this->imageService = $this->app->make(ImageService::class);
    }
    public function testImageServiceNotNull(): void
    {
        self::assertNotNull($this->imageService);
    }

    public function testSeederCreated(): void
    {
        $this->assertDatabaseHas('images', ['id' => '1']);
        $this->assertDatabaseCount('images', 3);
    }

    public function testGetAllImage(): void
    {
        $collection = $this->imageService->getAllImages();
        self::assertInstanceOf(Collection::class, $collection);
        $this->assertNotNull($collection->toQuery()->get());
    }

    public function testGetImageById(): void
    {

        $this->imageService->createImage([
            'name' => 'Image By Id',
            'url' => 'Image By Id Test Case'
        ]);

        $this->assertDatabaseHas('images', [
            'name' => 'Image By Id',
            'url' => 'Image By Id Test Case'
        ]);

        $image = Image::where('name', 'Image By Id')->first();
        $imageId = $image->id;
        $imageFromService = $this->imageService->getImageById($imageId);
        $imageIdFromService = $imageFromService->id;
        $this->assertSame($imageId, $imageIdFromService);
    }

    public function testCreateImage(): void
    {
        $this->imageService->createImage([
            'name' => 'Image Create',
            'url' => 'Image Create Test Case'
        ]);

        $this->assertDatabaseHas('images', [
            'name' => 'Image Create',
            'url' => 'Image Create Test Case'
        ]);
    }

    public function testUpdateImage(): void
    {
        $this->imageService->createImage([
            'name' => 'Image Create',
            'url' => 'Image Update Test Case'
        ]);

        $this->assertDatabaseHas('images', [
            'name' => 'Image Create',
            'url' => 'Image Update Test Case'
        ]);

        $imageId = Image::where('name', 'Image Create')->first()->id;

        $this->imageService->updateImage($imageId, [
            'name' => 'Image Update',
            'url' => 'Image Updated Test Case'
        ]);

        $this->assertDatabaseHas('images', [
            'name' => 'Image Update',
            'url' => 'Image Updated Test Case'
        ]);

        $this->assertDatabaseMissing('images', [
            'name' => 'Image Create',
            'url' => 'Image Update Test Case'
        ]);
    }

    public function testDeleteImage(): void
    {
        $this->imageService->createImage([
            'name' => 'Image Create',
            'url' => 'Image Delete Test Case'
        ]);

        $this->assertDatabaseHas('images', [
            'name' => 'Image Create',
            'url' => 'Image Delete Test Case'
        ]);

        $imageId = Image::where('name', 'Image Create')->first()->id;

        $this->imageService->deleteImage($imageId);

        $this->assertDatabaseMissing('images', [
            'name' => 'Image Create',
            'url' => 'Image Delete Test Case'
        ]);
    }
}
