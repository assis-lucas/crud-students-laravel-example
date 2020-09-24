@extends('layouts.app', ['pageTitle' => 'Visualizando ' . $student->name])
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Ver aluno</h3>
                    <a href="{{ route('students.index')}}" class="btn btn-info alert-info float-right"><i
                            class="fa fa-backward"></i> Voltar</a>
                </div>

                <div class="card-body">

                    Nome: <strong>{{ $student->name }}</strong>

                    <br>

                    Curso(s):
                    @foreach($student->courses as $course)
                    <strong>
                        {{ $course->name }}
                    </strong>,
                    @endforeach

                    <br>

                    @if($student->image)
                    Imagem:

                    <img height="150" src="{{ asset(config('media.image') . $student->image )}}"
                        style="display: block;" />

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
