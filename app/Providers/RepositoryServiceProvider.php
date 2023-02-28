<?php

namespace App\Providers;

use App\Services\ImageService;
use App\Services\Impl\ImageServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        ImageService::class => ImageServiceImpl::class,
        PostService::class => PostServiceImpl::class,
        TagService::class => TagServiceImpl::class,
        ImageRepository::class => ImageRepositoryImpl::class,
        PostRepository::class => PostRepositoryImpl::class,
        TagRepository::class => TagRepositoryImpl::class,
    ];

    public function provides(): array
    {
        return [
            ImageService::class,
            PostService::class,
            TagService::class,
            ImageRepository::class,
            PostRepository::class,
            TagRepository::class,
        ];
    }
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
