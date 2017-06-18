@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="panel panel-default col-md-10">
            <div class="panel-heading">Ordenes de Compra</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div id="alert" class="alert col-sm-8" hidden>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <div id="message">Success!</div>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                {!! Form::open(['url' => '/procesar_oc', 'id' => 'orden_compra_form', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        {{-- IS NEW PROYECTO? --}}
                        <div class="col-xs-4">
                            {!! Form::checkbox('is_new_project',1, true,['id' => 'is_new_project']) !!}
                            {!! Form::label('is_new_project', '¿Proyecto Nuevo?') !!}
                        </div>
                        {{-- IS NEW PROVEEDOR ? --}}
                        <div class="col-xs-4">
                            {!! Form::checkbox('is_new_proveedor',1, true,['id' => 'is_new_proveedor']) !!}
                            {!! Form::label('is_new_proveedor', '¿Nuevo Proveedor?') !!}
                        </div>
                        {{-- ¿FACTURA EXENTA? --}}
                        <div class="col-xs-4">
                            {!! Form::checkbox('factura_exenta',1, false) !!}
                            {!! Form::label('factura_exenta', '¿Factura Exenta?', ['class' => 'awesome']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {{-- ID PROYECTO --}}
                        <div class="col-xs-4" id="container_id_proyecto" hidden>
                            {!! Form::label('id_proyecto', 'Proyecto') !!}
                            {!! Form::select('id_proyecto', $listaProyectos, null, ['id'=>'id_proyecto','placeholder' => 'Seleccione...','class' => 'form-control']) !!}
                        </div>
                        {{-- CODIGO PROYECTO --}}
                        <div class="col-xs-4" id="container_codigo_proyecto" >
                            {!! Form::label('codigo_proyecto', 'Código Proyecto') !!}
                            {!! Form::text('codigo_proyecto', null, ['class' => 'form-control','required']) !!}
                        </div>
                        {{--NOMBRE PROVEEDOR--}}
                        <div class="col-xs-4" >
                            {!! Form::label('nombre', 'Nombre Proveedor') !!}
                            {!! Form::text('nombre','',array('class' => 'form-control','required')) !!}
                        </div>
                        {{-- ID PROVEEDOR --}}
                        <div class="col-xs-4" >
                            <div id="container_id_proveedor" hidden >
                                {!! Form::label('id_proveedor', 'Proveedor') !!}
                                {!! Form::select('id_proveedor', $listaProveedores, null, ['id'=>'id_proveedor','placeholder' => 'Seleccione...','class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{--DIRECCION--}}
                        <div class="col-xs-4">
                            {!! Form::label('direccion', 'Direccion', ['class' => 'awesome']) !!}
                            {!! Form::text('direccion','',['class' => 'form-control','required' ]) !!}
                        </div>
                        {{--RUT--}}
                        <div class="col-xs-4">
                            {!! Form::label('rut', 'RUT', ['class' => 'awesome']) !!}
                            {!! Form::text('rut','',['class' => 'form-control','required' ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {{--COMUNA--}}
                        <div class="col-xs-4">
                            {!! Form::label('comuna', 'Comuna', ['class' => 'awesome']) !!}
                            {!! Form::text('comuna','',['class' => 'form-control','required' ]) !!}
                        </div>
                        {{--GIRO--}}
                        <div class="col-xs-4">
                            {!! Form::label('giro', 'Giro', ['class' => 'awesome']) !!}
                            {!! Form::text('giro','',['class' => 'form-control','required' ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {{--FECHA EMISION--}}
                        <div class="col-xs-4">
                            {!! Form::label('fecha_emision', 'Fecha Emisión', ['class' => 'awesome']) !!}
                            {!! Form::date('fecha_emision', \Carbon\Carbon::now(),['class' => 'form-control','required']) !!}
                        </div>
                        {{--EMAIL--}}
                        <div class="col-xs-4">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::email('email','', ['class' => 'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {{--FORMA PAGO--}}
                        <div class="col-xs-4">
                            {!! Form::label('id_tipo_pago', 'Forma Pago', ['class' => 'awesome']) !!}
                            {!! Form::select('id_tipo_pago', $listaFormaPago, null, ['placeholder' => 'Seleccione...','class' => 'form-control','required']) !!}
                        </div>
                        {{--TELÉFONO FIJO--}}
                        <div class="col-xs-4">
                            {!! Form::label('telefono_fijo', 'Teléfono Fijo', ['class' => 'awesome']) !!}
                            {!! Form::number('telefono_fijo','',['class' => 'form-control','required','maxlength' => 9 ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {{--TELÉFONO MOVIL--}}
                        <div class="col-xs-4">
                            {!! Form::label('telefono_movil', 'Teléfono Movil', ['class' => 'awesome']) !!}
                            {!! Form::number('telefono_movil','',['class' => 'form-control' ]) !!}
                        </div>
                        {{--PLAZO ENTRAGA--}}
                        <div class="col-xs-4">
                            {!! Form::label('plazo_entrega', 'Plazo Entrega', ['class' => 'awesome']) !!}
                            {!! Form::text('plazo_entrega','',['class' => 'form-control','required' ]) !!}
                        </div>
                        {{--SUBMIT--}}
                        <div class="col-xs-4">
                            </br>{!! Form::submit('Generar OC',['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div id="container_detalle_oc" class="panel-body">
                            <div class="form-group">
                                <div class="col-xs-1">
                                    {!! Form::label('detalle[0][codigo]', 'Código') !!}
                                    {!! Form::text('detalle[0][codigo]','',['class' => 'form-control','required' ]) !!}
                                </div>
                                <div class="col-xs-1">
                                    {!! Form::label('detalle[0][cantidad]', 'Cantidad') !!}
                                    {!! Form::number('detalle[0][cantidad]','',['id'=>'detalle_0_cantidad','class' => 'form-control detalle_oc','required','data-row' => 0,'min' => 0]) !!}
                                </div>
                                <div class="col-xs-5">
                                    {!! Form::label('detalle[0][item]', 'Item') !!}
                                    {!! Form::text('detalle[0][item]','',['class' => 'form-control','required' ]) !!}
                                </div>
                                <div class="col-xs-2">
                                    {!! Form::label('detalle[0][valor_unitario]', 'Valor Unitario') !!}
                                    {!! Form::number('detalle[0][valor_unitario]','',['id'=>'detalle_0_valor_unitario','class' => 'form-control detalle_oc','required','data-row' => 0,'min' => 0]) !!}
                                </div>
                                <div class="col-xs-2">
                                    {!! Form::label('detalle[0][valor_total]', 'Valor Total') !!}
                                    {!! Form::number('detalle[0][valor_total]','',['id'=>'detalle_0_valor_total','class' => 'form-control','readonly','data-row' => 0,'min' => 0]) !!}
                                </div>
                                <div class="col-xs-1">
                                    </br><button id="add_detalle_oc" type="button" data-counter="1" class="btn btn-success btn-sm btn-round"><span class="glyphicon glyphicon-plus"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-4">
                            {!! Form::label('solicita', 'Solicita', ['class' => 'awesome']) !!}
                            {!! Form::text('solicita','',['class' => 'form-control','required' ]) !!}
                        </div>
                        <div class="col-xs-4">
                            {!! Form::label('autoriza', 'Autoriza', ['class' => 'awesome']) !!}
                            {!! Form::text('autoriza','',['class' => 'form-control' ,'required']) !!}
                        </div>
                        <div class="col-xs-4">
                            {!! Form::label('revisa', 'revisa', ['class' => 'awesome']) !!}
                            {!! Form::text('revisa','',['class' => 'form-control' ,'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            {!! Form::label('observacion', 'Observacion') !!}
                            {!! Form::textArea('observacion','',['class' => 'form-control','rows' => 5,'required']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
