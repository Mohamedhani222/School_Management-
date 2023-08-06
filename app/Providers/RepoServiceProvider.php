<?php

namespace App\Providers;

use App\interfaces\GraduatedRepositoryInterface;
use App\interfaces\StudentPromotionRepositoryInterface;
use App\interfaces\StudentRepositoryInterface;
use App\interfaces\TeacherRepositoryInterface;
use App\Repository\GraduatedRepository;
use App\Repository\StudentPromotionRepository;
use App\Repository\StudentRepository;
use App\Repository\TeacherRepository;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            TeacherRepositoryInterface::class,
            TeacherRepository::class,
        );
        $this->app->bind(
            StudentRepositoryInterface::class,
            StudentRepository::class,
        );
        $this->app->bind(
            StudentPromotionRepositoryInterface::class,
            StudentPromotionRepository::class,
        );
        $this->app->bind(
            GraduatedRepositoryInterface::class,
            GraduatedRepository::class,
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
