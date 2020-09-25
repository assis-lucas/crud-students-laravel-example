@extends('layouts.app', ['pageTitle' => 'Novo curso'])
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Novo curso</h3>
                    <a href="{{ route('courses.index')}}" class="btn btn-info alert-info float-right"><i
                            class="fa fa-backward"></i> Voltar</a>
                </div>

                <div class="card-body">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="post" action="{{ route('courses.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <strong>Nome</strong><small style="color:red;">(*)</small>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" />
                        </div>

                        <div class="form-group">
                            <strong>Carga horária</strong><small style="color:red;">(*)</small>
                            <input type="number" class="form-control" name="workload" value="{{ old('workload') }}" />
                        </div>

                        <button type="submit" class="btn btn-secondary alert-secondary"><i class="fa fa-save"></i>
                            Salvar curso</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
