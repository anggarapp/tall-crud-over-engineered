<?php

namespace App\Providers;

use App\Repositories\ImageRepository;
use App\Repositories\Impl\ImageRepositoryImpl;
use App\Repositories\Impl\PostRepositoryImpl;
use App\Repositories\Impl\TagRepositoryImpl;
use App\Repositories\PostRepository;
use App\Repositories\TagRepository;
use App\Services\ImageService;
use App\Services\Impl\ImageServiceImpl;
use App\Services\Impl\PostServiceImpl;
use App\Services\Impl\TagServiceImpl;
use App\Services\PostService;
use App\Services\TagService;
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
