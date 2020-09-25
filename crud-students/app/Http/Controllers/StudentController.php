<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StudentRepository;
use App\Repositories\CourseRepository;
use App\Http\Requests\StudentRequest;

class StudentController extends Controller
{
    protected $studentRepo;
    protected $courseRepo;

    public function __construct(StudentRepository $studentRepo, CourseRepository $courseRepo)
    {
        $this->studentRepo = $studentRepo;
        $this->courseRepo = $courseRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = $this->studentRepo->getAll(10);
        return view('admin.students.index', compact('students'))
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
        return view('admin.students.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $student = $this->studentRepo->store($request);

        if (!$student) {
            return redirect()->route('students.index')->with('error', 'Erro ao cadastrar');
        }

        return redirect()->route('students.index')->with('success', $student->name . ' cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $student = $this->studentRepo->find($id);
        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $student = $this->studentRepo->find($id);
        $courses = $this->courseRepo->getAll();
        return view('admin.students.edit', compact('student', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
        $student = $this->studentRepo->update($request, $id);

        if (!$student) {
            return redirect()->route('students.index')->with('error', 'Erro ao atualizar');
        }

        return redirect()->route('students.index')->with('info', $student->name . ' atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $student = $this->studentRepo->destroy($id);

        if (!$student) {
            return redirect()->route('students.index')->with('error', 'Erro ao remover');
        }

        return redirect()->route('students.index')->with('info', 'Aluno removido com sucesso');
    }
}
