<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CourseRepository;
use App\Http\Requests\CourseRequest;

class CourseController extends Controller
{
    protected $courseRepo;

    public function __construct(CourseRepository $courseRepo)
    {
        $this->courseRepo = $courseRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->courseRepo->getAll(10);
        return view('admin.courses.index', compact('courses'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = $this->courseRepo->getAll();
        return view('admin.courses.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $course = $this->courseRepo->store($request);

        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Erro ao cadastrar');
        }

        return redirect()->route('courses.index')->with('success', $course->name . ' cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $course = $this->courseRepo->find($id);
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $course = $this->courseRepo->find($id);
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, int $id)
    {
        $course = $this->courseRepo->update($request, $id);

        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Erro ao atualizar');
        }

        return redirect()->route('courses.index')->with('info', $course->name . ' atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $course = $this->courseRepo->destroy($id);

        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Erro ao remover');
        }

        return redirect()->route('courses.index')->with('info', 'Curso removido com sucesso');
    }
}
