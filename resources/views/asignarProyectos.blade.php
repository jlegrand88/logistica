@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="panel panel-default col-md-10" style="min-height: 600px">
            <div class="panel-heading">Asignar Proyectos a Usuarios</div>
            <div class="panel-body">
                @if($message)
                    <div class="row">
                        <div id="alert" class="alert alert-success" >
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <div id="message">{{ $message  }}</div>
                        </div>
                    </div>
                @endif
                {!! Form::open(['url' => '/procesar_asignar_proyectos', 'id' => 'asignar_proyectos_form', 'class' => 'form-inline']) !!}
                    <div class="form-group">
                        {{-- ID PROYECTO --}}
                        {!! Form::label('id_proyecto', 'Proyecto') !!}
                        {!! Form::select('id_proyecto', $proyectos, null, ['id'=>'id_proyecto','placeholder' => 'Seleccione','class' => 'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {{-- ID USUARIO --}}
                        <div id="container_usuarios" >
                            {!! Form::label('usuarios', 'Usuarios') !!}
                            {!! Form::select('usuarios', $usuarios, null, ['id'=>'usuarios','multiple'=>'multiple','name'=>'usuarios[]','class' => 'form-control selec2','required']) !!}
                        </div>
                    </div>
                    {!! Form::submit('Guardar',['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/asignarProyectos.js') }}"></script>
@endsection