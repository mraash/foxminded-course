<?php

namespace App\Providers;

use App\Packages\Report\Data\FileSystem\DataFileNames;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DataFileNames::class, function () {
            return DataFileNames::construct()
                ->setFolder(base_path(env('REPORT_FOLDER')))
                ->setStartFilename(env('REPORT_START_FILENAME'))
                ->setEndFilename(env('REPORT_END_FILENAME'))
                ->setAbbreviationFilename(env('REPORT_ABBREVIATIONS_FILENAME'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
