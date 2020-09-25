@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="float-left">Curso</h3>
            <a href="{{ route('courses.create')}}" class="btn btn-success float-right mb-2"
                style="margin-left: 0.5rem !important;color: #fff;"><i class="fa fa-user-plus"></i> Novo curso</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Nome</td>
                        <td>Carga horária</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->workload }}</td>
                        <td>
                            <a href="{{ route('courses.edit', $course->id)}}" class="btn btn-primary"><i
                                    class="fa fa-edit"></i> Editar</a>
                            <a href="{{ route('courses.show', $course->id)}}" class="btn text-white btn-warning"><i
                                    class="fa fa-eye"></i> Visualizar</a>
                            <form action="{{ route('courses.destroy', $course->id)}}" method="post"
                                style="display: inline;">
                                @csrf
                                @method('patch')
                                <button class="btn btn-danger" type="submit"><i class="fa fa-ban"></i> Remover</button>
                            </form>
                            {{-- GERAR CERTIFICADO AQUI --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $courses->render() !!}
        </div>
    </div>
</div>
@endsection
