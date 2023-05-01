<?php

namespace App\Http\Livewire\Lesson;

use App\Http\Livewire\Course\Course;
use App\Models\Course as CourseAlias;
use App\Models\Lesson;
use App\Models\LessonFile;
use App\Models\LessonFilesBundle;
use App\Models\LessonVideo;
use App\Models\LessonVideosBundle;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class LessonUpdate extends Component
{
    use WithFileUploads;

    public $lesson_id;

    public $lesson;
    public $courses;

    public $name;
    public $task;
    public $description;
    public $lesson_number;
    public $course_id;

    public Collection $files;
    public Collection $videos;


    public $file_path = [];

    public $counter = [];
    public $video;
    public $i = 1;

    protected $rules = [
        'name' => ['required', 'string'],
        'task' => ['required', 'string'],
        'description' => ['required', 'string'],
        'lesson_number' => ['required', 'numeric'],
        'course_id' => ['required', 'numeric'],
    ];

    protected $listeners = [
        'refreshComponent' => 'getFiles',
        'refreshVideos' => 'getVideos',
    ];

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->counter ,$i);
    }

    public function remove($i)
    {
        unset($this->counter[$i]);
    }

    private function resetInputFields(){
        $this->video = '';
    }

    public function getFiles() {
        $this->files = LessonFilesBundle::query()->where('lesson_id', '=', $this->lesson->id)->get();
    }

    public function getVideos() {
        $this->videos = LessonVideosBundle::query()->where('video_id', '=', $this->lesson->id)->get();
    }

    public function update($id)
    {
        $validated = $this->validate($this->rules);
        Lesson::query()->where('id', '=', $id)->update($validated);

        // Загрузка файлов в таблицу lesson_files

        if (count($this->file_path) > 0) {
            $validatedFile['file_path']  = $this->validate([
                'file_path' => ['required', 'max:5120'],
            ]);
            foreach ($this->file_path as $file) {
                $validatedFile['file_path'] = $file->store('public/lessons');
                $lessonFile = LessonFile::create($validatedFile);
                LessonFilesBundle::create([
                    'lesson_id' => $id,
                    'file_id' => $lessonFile->id
                ]);
            }
            $this->emit('refreshComponent');
            $this->file_path = '';
        }

        // Загрузка путей видео в таблицу lesson_videos

        $validatedDate = $this->validate([
            'video.0' => 'required',
            'video.*' => 'required',
        ]);

        foreach ($this->video as $key => $value) {
            $lessonVideo = LessonVideo::create(['video_path' => $this->video[$key]]);
            // Заполнение таблицы связки lesson_videosBundle
            $videoBundle['lesson_id'] = $id;
            $videoBundle['video_id'] = $lessonVideo->id;
            LessonVideosBundle::create($videoBundle);
        }

        $this->emit('refreshVideos');

        $this->counter = [];
        $this->resetInputFields();

    }

    public function destroy($id)
    {
        try {
            Course::find($id)->delete();
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong while deleting category!!");
        }
    }

    public function deleteFile(LessonFile $file) {
        $file->delete();
        $this->emit('refreshComponent');
    }

    public function deleteVideo(LessonVideo $video) {
        $video->delete();
        $this->emit('refreshVideos');
    }

    public function render()
    {
        $this->videos = LessonVideosBundle::query()->where('lesson_id', '=', $this->lesson->id)->get();
        $this->files = LessonFilesBundle::query()->where('lesson_id', '=', $this->lesson->id)->get();
        return view('livewire.admin.lesson.editForm');
    }

    public function mount()
    {
        $this->name = $this->lesson->name;
        $this->task = $this->lesson->task;
        $this->description = $this->lesson->description;
        $this->lesson_number = $this->lesson->lesson_number;
        $this->course_id = $this->lesson->course_id;
    }
}
