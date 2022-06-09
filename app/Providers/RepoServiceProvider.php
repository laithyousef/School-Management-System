<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repository\TeacherRepository_Interface','App\Repository\TeacherRepository');

        $this->app->bind('App\Repository\StudentRepository_Interface','App\Repository\StudentRepository' );

        $this->app->bind('App\Repository\StudentPromotionRepository_Interface','App\Repository\StudentPromotionRepository' );

        $this->app->bind('App\Repository\StudentGraduatedRepository_Interface','App\Repository\StudentGraduatedRepository' );

        $this->app->bind('App\Repository\FeesRepository_Interface','App\Repository\FeesRepository' );
        
        $this->app->bind('App\Repository\FeesInvoicesRepository_Interface','App\Repository\FeesInvoicesRepository' );

        $this->app->bind('App\Repository\StudentsReceiptRepository_Interface','App\Repository\StudentsReceiptRepository' );
        
        $this->app->bind('App\Repository\FeeProcessingRepository_Interface','App\Repository\FeeProcessingRepository' );
        
        $this->app->bind('App\Repository\StudentPaymentRepository_Interface','App\Repository\StudentPaymentRepository' );
        
        $this->app->bind('App\Repository\StudentsAttendanceRepository_Interface','App\Repository\StudentsAttendanceRepository' );
        
        $this->app->bind('App\Repository\SubjectRepository_Interface','App\Repository\SubjectRepository' );
        
        $this->app->bind('App\Repository\QuizRepository_Interface','App\Repository\QuizRepository' );
        
        $this->app->bind('App\Repository\QuestionRepository_Interface','App\Repository\QuestionRepository' );

        $this->app->bind('App\Repository\LibraryRepository_Interface','App\Repository\LibraryRepository' );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
