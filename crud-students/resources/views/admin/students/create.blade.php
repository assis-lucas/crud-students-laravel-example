@extends('layouts.app', ['pageTitle' => 'Novo aluno'])
@section('css')
@parent
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #2255a4;
        border: 1px solid #2255a4;
        color: #fff;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #999;
    }

    .select2-container--default .select2-selection--multiple {
        height: auto;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Novo aluno</h3>
                    <a href="{{ route('students.index')}}" class="btn btn-info alert-info float-right"><i
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

                    <form method="post" action="{{ route('students.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <strong>Nome</strong><small style="color:red;">(*)</small>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" />
                        </div>

                        <div class="form-group">
                            <label for="courses">
                                <strong>Curso(s):</strong>
                            </label>
                            <select id="courses" class="select2 form-control m-t-15" name="courses[]"
                                multiple="multiple" style="height: 36px;width: 100%;">
                                @foreach($courses as $course)
                                <option value="{{ $course->name }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <strong>Imagem </strong>
                            <input class="form-control image" type="file" name="image" value="{{ old('image') }}"
                                style="padding: 3px;">
                        </div>

                        <button type="submit" class="btn btn-secondary alert-secondary"><i class="fa fa-save"></i>
                            Salvar aluno</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#courses').select2({
                tags: false,
                tokenSeparators: [','],
                "language": {
                    "noResults": function(){
                        return "Nenhum resultado encontrado";
                    }
                },
                escapeMarkup: function (markup) {
                    return markup;
                }
        });

        $('.image').on('change', function(e){
            var file = e.target.files[0];
            var type = file.name.split('.')[1].toLowerCase();
            var inputName = e.target.name;

            var allowed = ['png', 'jpeg', 'jpg']
            if(!allowed.includes(type)) {
                toastr.warning('Formato inválido!')
                $(`input[name=${inputName}]`).val('');
            }
        });


    });
</script>
@endsection
