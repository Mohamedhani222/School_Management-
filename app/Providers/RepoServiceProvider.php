<?php

namespace App\Providers;

use App\interfaces\FeesInvoicesRepositoryInterface;
use App\interfaces\FeesRepositoryInterface;
use App\interfaces\GraduatedRepositoryInterface;
use App\interfaces\StudentPromotionRepositoryInterface;
use App\interfaces\StudentRepositoryInterface;
use App\interfaces\TeacherRepositoryInterface;
use App\Repository\FeesInvoicesRepository;
use App\Repository\FeesRepository;
use App\Repository\GraduatedRepository;
use App\Repository\StudentPromotionRepository;
use App\Repository\StudentRepository;
use App\Repository\TeacherRepository;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{

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
        $this->app->bind(
            FeesRepositoryInterface::class,
            FeesRepository::class,
        );
        $this->app->bind(
            FeesInvoicesRepositoryInterface::class,
            FeesInvoicesRepository::class,
        );
    }


    public function boot(): void
    {
        //
    }
}
