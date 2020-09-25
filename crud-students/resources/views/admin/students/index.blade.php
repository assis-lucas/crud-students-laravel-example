@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="float-left">Aluno</h3>
            <a href="{{ route('students.create')}}" class="btn btn-success float-right mb-2"
                style="margin-left: 0.5rem !important;color: #fff;"><i class="fa fa-user-plus"></i> Novo aluno</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Nome</td>
                        <td>Cursos</td>
                        <td>Imagem</td>
                        <td>Ações</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>
                            @foreach($student->courses as $course)
                            <small>{{ $course->name }}, </small>
                            @endforeach
                        </td>
                        <td>
                            @if($student->image)
                            <img class="img-fluid img-circle"
                                src="{{ asset(config('media.image') .  $student->image) }}" style="width: 80px;">
                            @else
                            <span>Sem imagem</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('students.edit', $student->id)}}" class="btn btn-primary"><i
                                    class="fa fa-edit"></i> Editar</a>
                            <a href="{{ route('students.show', $student->id)}}" class="btn text-white btn-warning"><i
                                    class="fa fa-eye"></i> Visualizar</a>
                            <form action="{{ route('students.destroy', $student->id)}}" method="post"
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
            {!! $students->render() !!}
        </div>
    </div>
</div>
@endsection

