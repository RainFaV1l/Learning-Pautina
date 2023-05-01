<?php


use App\Http\Livewire\Application\ApplicationController;
use App\Http\Livewire\CatalogController;
use App\Http\Livewire\CategoryController;
use App\Http\Livewire\CourseController;
use App\Http\Livewire\Dashboard\DashboardController;
use App\Http\Livewire\Dashboard\GroupModuleController;
use App\Http\Livewire\GroupController;
use App\Http\Livewire\IndexController;
use App\Http\Livewire\Lesson\LessonController;
use App\Http\Livewire\TeacherPanel\TeacherPanelController;
use App\Http\Livewire\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Livewire'], function () {

    Route::controller(IndexController::class)->group(function () {
        Route::get('/', 'index')->name('index.index');
        Route::get('/#benefits', 'index')->name('index.benefits');
        Route::get('/#about', 'index')->name('index.about');
        Route::get('/#review', 'index')->name('index.review');
    });

    Route::controller(CatalogController::class)->group(function () {
        Route::get('/catalog', 'index')->name('catalog.index');
        Route::get('/catalog/{id}', 'show')->name('catalog.show');
    });

    Route::controller(UserController::class)->middleware(['auth'])->group(function () {
        Route::get('profile', 'index')->name('profile.index');
        Route::post('profile/changeAvatar', 'changeAvatar')->name('profile.changeAvatar');
    });

    Route::controller(TeacherPanelController::class)->middleware(['auth'])->prefix('teacher-panel')->group(function () {
        Route::get('/courses', 'courses')->name('teacher-panel.courses');
        Route::get('/courses/{id}/groups', 'groups')->name('teacher-panel.groups');
        Route::get('/courses/{course_id}/groups/{group_id}/module/{module_id}', 'group')->name('teacher-panel.group');
    });

    Route::controller(DashboardController::class)->middleware(['auth', 'admin'])->prefix('dashboard')->group(function () {
        Route::get('/show', 'index')->name('dashboard.index');
        Route::get('/lessons', 'lessons')->name('dashboard.lessons');
        Route::get('/courses', 'courses')->name('dashboard.courses');
        Route::get('/categories', 'categories')->name('dashboard.categories');
        Route::get('/users', 'users')->name('dashboard.users');
        Route::get('/groups', 'groups')->name('dashboard.groups');
        Route::get('/applications', 'applications')->name('dashboard.applications');
        Route::get('/modules', 'modules')->name('dashboard.modules');

        Route::controller(GroupModuleController::class)->middleware(['auth'])->prefix('modules')->group(function () {
            Route::get('/add', 'add')->name('modules.add');
            Route::get('/{id}/edit', 'edit')->name('modules.edit');
            Route::get('/{id}/more', 'more')->name('modules.more');
            Route::get('/{id}/more/add', 'addLesson')->name('modules.addLesson');
        });
        Route::controller(CourseController::class)->middleware(['auth'])->prefix('courses')->group(function () {
            Route::get('/add', 'add')->name('courses.add');
            Route::post('/add', 'store')->name('courses.store');
            Route::get('/{id}/edit', 'edit')->name('courses.edit');
            Route::get('/{id}/more', 'more')->name('courses.more');
        });

        Route::controller(CategoryController::class)->middleware(['auth'])->prefix('categories')->group(function () {
            Route::get('/add', 'addView')->name('categories.categoryAddView');
            Route::post('/add', 'store')->name('categories.categoryAdd');
            Route::get('/{id}/edit', 'editView')->name('categories.categoryEditView');
            Route::post('/{id}/edit', 'update')->name('categories.categoryEdit');
            Route::post('/{id}/delete', 'destroy')->name('categories.categoryDelete');
        });

        Route::controller(GroupController::class)->middleware(['auth'])->prefix('groups')->group(function () {
            Route::get('/add', 'addView')->name('groups.addView');
            Route::post('/add', 'store')->name('groups.store');
            Route::get('/{id}/edit', 'editView')->name('groups.editView');
            Route::post('/{id}/edit', 'update')->name('groups.update');
            Route::post('/{id}/delete', 'destroy')->name('groups.destroy');
        });

        Route::controller(LessonController::class)->middleware(['auth'])->prefix('lessons')->group(function () {
            Route::get('/add', 'add')->name('lessons.add');
            Route::get('/{id}/add', 'add')->name('lessons.addId');
            Route::post('/add', 'store')->name('lessons.store');
            Route::get('/{id}/edit', 'edit')->name('lessons.edit');
            Route::post('/{id}/edit', 'update')->name('lessons.update');
            Route::get('/{lesson_id}/more', 'dashboardMore')->name('dashboard.lessons.more');
        });

        Route::controller(ApplicationController::class)->middleware(['auth'])->prefix('applications')->group(function () {
            Route::get('/add', 'create')->name('applications.create');
        });
    });

    Route::controller(CourseController::class)->middleware(['auth'])->prefix('courses')->group(function () {
        Route::get('/', 'index')->name('courses.index');
        Route::get('/{id}/more', 'more')->name('courses.more')->middleware(['subscribe']);
    });

    Route::controller(ApplicationController::class)->middleware(['auth'])->prefix('applications')->group(function () {
        Route::get('/', 'index')->name('applications.index');
    });

    Route::controller(LessonController::class)->middleware(['auth'])->prefix('lessons')->group(function () {
        Route::get('/module/{module_id}/lesson/{lesson_id}/more', 'more')->name('lessons.more')->middleware(['lesson', 'module']);;
    });
});

Route::get('storage/{name}', function ($name) {

    $path = storage_path($name);

    $mime = \File::mimeType($path);

    header('Content-type: ' . $mime);

    return readfile($path);
})->where('name', '(.*)');

Route::post('storage/{name}', function ($name) {

    $path = storage_path($name);

    $mime = \File::mimeType($path);

    header('Content-type: ' . $mime);

    return readfile($path);
})->where('name', '(.*)');

//Route::get('/courses/add/livewire', \App\Http\Livewire\Courses::class);

//dd(Route::getRoutes());
//Auth::routes();

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require_once __DIR__ . '/jetstream.php';
