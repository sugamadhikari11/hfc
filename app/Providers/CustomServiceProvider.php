<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;  
use App\Http\Controllers\Backend\Gallery\GalleryController;
use App\Models\Setting\Setting;
use App\Repositories\Account\User\UserInterface;
use App\Repositories\Account\User\UserRepository;
use App\Repositories\Blogs\BlogsInterface;
use App\Repositories\Blogs\BlogsRepository;
use App\Repositories\Blogs\Category\BlogCategoryInterface;
use App\Repositories\Blogs\Category\BlogCategoryRepository;
use App\Repositories\Gallery\GalleryInterface;
use App\Repositories\Gallery\GalleryRepository;
use App\Repositories\MemberType\MemberTypeInterface;
use App\Repositories\MemberType\MemberTypeRepository;
use App\Repositories\Page\PageInterface;
use App\Repositories\Page\PageRepository;
use App\Repositories\Profile\UserProfileInterface;
use App\Repositories\Profile\UserProfileRepository;
use App\Repositories\Project\ProjectInterface;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Setting\SettingInterface;
use App\Repositories\Setting\SettingRepository;
use App\Repositories\Team\TeamInterface;
use App\Repositories\Team\TeamRepository;
use App\Repositories\Testimonial\TestimonialInterface;
use App\Repositories\Testimonial\TestimonialRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PageInterface::class, PageRepository::class);
        $this->app->bind(TestimonialInterface::class, TestimonialRepository::class);
        $this->app->bind(SettingInterface::class, SettingRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(UserProfileInterface::class, UserProfileRepository::class);
        $this->app->bind(MemberTypeInterface::class, MemberTypeRepository::class);
        $this->app->bind(TeamInterface::class, TeamRepository::class);
        $this->app->bind(ProjectInterface::class, ProjectRepository::class);

        $this->app->bind(GalleryInterface::class, GalleryRepository::class);
        $this->app->bind(BlogCategoryInterface::class, BlogCategoryRepository::class);
        $this->app->bind(BlogsInterface::class, BlogsRepository::class);

        $this->app->when(GalleryController::class)
            ->needs(GalleryInterface::class)
            ->give(function () {
                return app(GalleryInterface::class);
            });
    }

    /**
     * Bootstrap services.
     */
   public function boot(): void
    {
        $isInstaller = env('IS_INSTALLED');

        if (!$isInstaller && Schema::hasTable('settings')) {
            $settingData = Setting::first();
            View::share('settingData', $settingData);
        }
    }
}
