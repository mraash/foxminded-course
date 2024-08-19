<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\GroupsController;
use App\Http\Controllers\Pages\StudentsController;

Route::redirect('/', '/students');

Route::prefix('/groups')->controller(GroupsController::class)->group(function () {
    Route::get('/', 'showIndex')->name('pages.groups.index');
});

Route::prefix('/students')->controller(StudentsController::class)->group(function () {
    Route::get('/', 'showIndex')->name('pages.students.index');
    Route::get('/{id}', 'showSingle')->name('pages.students.single');

    Route::get('/add', 'showCreateForm')->name('pages.students.add');
    Route::post('/add', 'create')->name('actions.students.add');

    Route::get('/delete', 'showDeleteForm')->name('pages.students.delete');
    Route::delete('/delete', 'delete')->name('actions.students.delete');

    Route::delete('/{id}/courses/remove', 'removeCourse')->name('actions.students.courses.remove');

    Route::put('/{id}/courses/add', 'addCourse')->name('actions.students.courses.add');
});
