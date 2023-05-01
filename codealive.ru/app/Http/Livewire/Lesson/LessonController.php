<?php

namespace App\Http\Livewire\Lesson;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonFile;
use App\Models\LessonFilesBundle;
use App\Models\LessonVideo;
use App\Models\LessonVideosBundle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    public function add($id = null)
    {
        if ($id == null) {
            $courses = Course::all();
            return view('livewire.admin.lesson.add', compact('courses'));
        } else {
            $course = Course::findOrFail($id);
            return view('livewire.admin.lesson.add', compact('course'));
        }
    }

    public function edit($id)
    {
        $lesson_id = $id;
        $lesson = Lesson::findOrFail($id);
        $courses = Course::All();
        return view('livewire.admin.lesson.edit', compact('lesson_id', 'lesson', 'courses'));
    }


    public function more($module_id, $lesson_id)
    {
        $lesson = Lesson::find($lesson_id);
        return view('livewire.lesson.one-lesson', compact(['lesson_id', 'lesson', 'module_id']));
    }

    public function dashboardMore($lesson_id)
    {
        $lesson = Lesson::find($lesson_id);
        return view('livewire.lesson.one-lesson', compact(['lesson_id', 'lesson']));
    }


    public function store(Request $request)
    {

        // Загрузка файлов в таблицу lessons

        $validator = Validator::make(
            $request->all(),
            [
                'course_id' => ['required', 'numeric'],
                'name' => ['required', 'string', 'max:250'],
                'description' => ['required', 'string', 'max:500'],
                'task' => ['required', 'string', 'max:1000'],
                'lesson_number' => ['required', 'numeric']
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        $validated = $validator->validated();

        $lesson = Lesson::create($validated);

        // Загрузка файлов в таблицу lesson_files

        $validatorFiles = Validator::make($request->all(), [
            'file_path' => ['required', 'max:5120'],
        ]);

        if ($validatorFiles->fails()) {
            return back()->withErrors($validatorFiles->errors())->withInput($request->all());
        }

        $validatedFiles = $validatorFiles->validated();

        if ($request->file('file_path')) {
            foreach ($request->file('file_path') as $file) {
                $path = $file->store('public/lessons');
                $validatedFiles['file_path'] = $path;
                $lessonFile = LessonFile::create($validatedFiles);

                // Заполнение таблицы связки lesson_files_bundle
                $fileBundle['lesson_id'] = $lesson->id;
                $fileBundle['file_id'] = $lessonFile->id;
                LessonFilesBundle::create($fileBundle);
            }
        }

        // Загрузка путей видео в таблицу lesson_videos

        $validatorVideos = Validator::make($request->all(), [
            'inputs.*.video_path' => ['required', 'string', 'max:255'],
        ]);

        if ($validatorVideos->fails()) {
            return back()->withErrors($validatorFiles->errors())->withInput($request->all());
        }

        $validatedVideos = $validatorVideos->validated();

        foreach ($request->inputs as $input) {
            $validatedVideos['video_path'] = $input;
            $lessonVideo = LessonVideo::create($validatedVideos['video_path']);

            // Заполнение таблицы связки lesson_videosBundle
            $videoBundle['lesson_id'] = $lesson->id;
            $videoBundle['video_id'] = $lessonVideo->id;
            LessonVideosBundle::create($videoBundle);
        }

        return redirect()->route('courses.more', $request->course_id);
    }
}
