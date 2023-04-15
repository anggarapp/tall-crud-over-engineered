<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->imageService->createImage([
            'name' => 'Image By Id',
            'image' => $file,
        ]);

        $this->assertDatabaseHas('images', [
            'name' => 'Image By Id'
        ]);

        $image = Image::where('name', 'Image By Id')->first();
        $imageId = $image->id;
        $imageFromService = $this->imageService->getImageById($imageId);
        $imageIdFromService = $imageFromService->id;
        $this->assertSame($imageId, $imageIdFromService);
    }

    public function testCreateImage(): void
    {
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $this->imageService->createImage([
            'name' => 'Image Create',
            'image' => $file,
        ]);

        $this->assertDatabaseHas('images', [
            'name' => 'Image Create',
        ]);
    }



    public function testDeleteImage(): void
    {
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $this->imageService->createImage([
            'name' => 'Image Create',
            'image' => $file,
        ]);

        $this->assertDatabaseHas('images', [
            'name' => 'Image Create',
        ]);

        $imageId = Image::where('name', 'Image Create')->first()->id;

        $this->imageService->deleteImage($imageId);

        $this->assertDatabaseMissing('images', [
            'name' => 'Image Create',
        ]);
    }

    public function testUpdateImage(): void
    {
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $fileUpdate = UploadedFile::fake()->image('update.jpg');
        $this->imageService->createImage([
            'name' => 'Image Create',
            'image' => $file,
        ]);

        $this->assertDatabaseHas('images', [
            'name' => 'Image Create',
        ]);

        $imageId = Image::where('name', 'Image Create')->first()->id;
        $imageUrl = Image::where('name', 'Image Create')->first()->url;

        $this->imageService->updateImage($imageId, [
            'name' => 'Image Update',
            'image' => $fileUpdate,
            'oldImage' => $imageUrl,
        ]);

        $this->assertDatabaseHas('images', [
            'name' => 'Image Update',
        ]);

        $this->assertDatabaseMissing('images', [
            'name' => 'Image Create',
        ]);
    }
}
