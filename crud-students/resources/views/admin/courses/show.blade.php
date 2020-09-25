@extends('layouts.app', ['pageTitle' => 'Visualizando ' . $course->name])
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Ver curso</h3>
                    <a href="{{ route('courses.index')}}" class="btn btn-info alert-info float-right"><i
                            class="fa fa-backward"></i> Voltar</a>
                </div>

                <div class="card-body">

                    Nome: <strong>{{ $course->name }}</strong>

                    <br>

                    Carga horária: <strong>{{ $course->workload }}</strong>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
