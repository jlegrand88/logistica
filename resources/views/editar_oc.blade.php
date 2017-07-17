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
                    {!!  Form::hidden('id_orden_compra',$ordenCompra->id_orden_compra,array('class' => 'form-control')) !!}
                    <div class="form-group">
                        {{-- IS NEW PROYECTO? --}}
                        <div class="col-xs-4">
                            {{--{!! Form::checkbox('is_new_project',1, false,['id' => 'is_new_project']) !!}--}}
                            {{--{!! Form::label('is_new_project', '¿Proyecto Nuevo?') !!}--}}
                        </div>
                        {{-- IS NEW PROVEEDOR ? --}}
                        <div class="col-xs-4">
                            {!! Form::checkbox('is_new_proveedor',1, false,['id' => 'is_new_proveedor']) !!}
                            {!! Form::label('is_new_proveedor', '¿Nuevo Proveedor?') !!}
                        </div>
                        {{-- ¿FACTURA EXENTA? --}}
                        <div class="col-xs-4">
                            {!! Form::checkbox('factura_exenta',1, $ordenCompra->factura_exenta) !!}
                            {!! Form::label('factura_exenta', '¿Factura Exenta?', ['class' => 'awesome']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {{-- ID PROYECTO --}}
                        <div class="col-xs-4" id="container_id_proyecto" >
                            {!! Form::label('id_proyecto', 'Proyecto') !!}
                            {!! Form::select('id_proyecto', $listaProyectos, $ordenCompra->id_proyecto, ['id'=>'id_proyecto','placeholder' => 'Seleccione...','class' => 'form-control','required']) !!}
                        </div>
                        {{-- CODIGO PROYECTO --}}
                        <div class="col-xs-4" id="container_codigo_proyecto" hidden >
                            {!! Form::label('codigo_proyecto', 'Código Proyecto') !!}
                            {!! Form::text('codigo_proyecto', null, ['class' => 'form-control']) !!}
                        </div>
                        {{--NOMBRE PROVEEDOR--}}
                        <div class="col-xs-4" >
                            {!! Form::label('nombre', 'Nombre Proveedor') !!}
                            {!! Form::text('nombre',$proveedor->nombre,array('class' => 'form-control','required')) !!}
                        </div>
                        {{-- ID PROVEEDOR --}}
                        <div class="col-xs-4" >
                            <div id="container_id_proveedor"  >
                                {!! Form::label('id_proveedor', 'Proveedor') !!}
                                {!! Form::select('id_proveedor', $listaProveedores, $ordenCompra->id_proveedor, ['id'=>'id_proveedor','placeholder' => 'Seleccione...','class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{--DIRECCION--}}
                        <div class="col-xs-4">
                            {!! Form::label('direccion', 'Direccion', ['class' => 'awesome']) !!}
                            {!! Form::text('direccion',$proveedor->direccion,['class' => 'form-control','required' ]) !!}
                        </div>
                        {{--RUT--}}
                        <div class="col-xs-4">
                            {!! Form::label('rut', 'RUT', ['class' => 'awesome']) !!}
                            {!! Form::text('rut',$proveedor->rut,['class' => 'form-control','required' ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {{--COMUNA--}}
                        <div class="col-xs-4">
                            {!! Form::label('comuna', 'Comuna', ['class' => 'awesome']) !!}
                            {!! Form::text('comuna',$proveedor->comuna,['class' => 'form-control','required' ]) !!}
                        </div>
                        {{--GIRO--}}
                        <div class="col-xs-4">
                            {!! Form::label('giro', 'Giro', ['class' => 'awesome']) !!}
                            {!! Form::text('giro',$proveedor->giro,['class' => 'form-control','required' ]) !!}
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
                            {!! Form::email('email',$proveedor->email, ['class' => 'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {{--FORMA PAGO--}}
                        <div class="col-xs-4">
                            {!! Form::label('id_tipo_pago', 'Forma Pago', ['class' => 'awesome']) !!}
                            {!! Form::select('id_tipo_pago', $listaFormaPago, $ordenCompra->id_tipo_pago, ['placeholder' => 'Seleccione...','class' => 'form-control','required']) !!}
                        </div>
                        {{--TELÉFONO FIJO--}}
                        <div class="col-xs-4">
                            {!! Form::label('telefono_fijo', 'Teléfono Fijo', ['class' => 'awesome']) !!}
                            {!! Form::number('telefono_fijo',$proveedor->telefono,['class' => 'form-control','maxlength' => 9 ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {{--TELÉFONO MOVIL--}}
                        <div class="col-xs-4">
                            {!! Form::label('telefono_movil', 'Teléfono Movil', ['class' => 'awesome']) !!}
                            {!! Form::number('telefono_movil',$proveedor->telefono_movil,['class' => 'form-control' ]) !!}
                        </div>
                        {{--PLAZO ENTRAGA--}}
                        <div class="col-xs-4">
                            {!! Form::label('plazo_entrega', 'Plazo Entrega', ['class' => 'awesome']) !!}
                            {!! Form::text('plazo_entrega',$ordenCompra->plazo_entrega,['class' => 'form-control','required' ]) !!}
                        </div>
                        {{--SUBMIT--}}
                        <div class="col-xs-4">
                            </br>{!! Form::submit('Generar OC',['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div id="container_detalle_oc" class="panel-body">
                            @foreach ($detalles as $detalle)
                                <div class="form-group" id="detalle_oc_{{$loop->index}}">
                                    @if($detalle->id_detalle_orden_compra)
                                        {!! Form::hidden('detalle['.$loop->index.'][id_detalle_orden_compra]',$detalle->id_detalle_orden_compra,['class' => 'form-control','required' ]) !!}
                                    @endif
                                    <div class="col-xs-1">
                                        {!! Form::label('detalle['.$loop->index.'][codigo]', 'Código') !!}
                                        {!! Form::text('detalle['.$loop->index.'][codigo]',$detalle->codigo,['class' => 'form-control','required' ]) !!}
                                    </div>
                                    <div class="col-xs-2">
                                        {!! Form::label('detalle['.$loop->index.'][cantidad]', 'Cantidad') !!}
                                        {!! Form::number('detalle['.$loop->index.'][cantidad]',$detalle->cantidad,['id'=>'detalle_'.$loop->index.'_cantidad','class' => 'form-control detalle_oc','required','data-row' => $loop->index,'min' => 0]) !!}
                                    </div>
                                    <div class="col-xs-4">
                                        {!! Form::label('detalle['.$loop->index.'][item]', 'Item') !!}
                                        {!! Form::text('detalle['.$loop->index.'][item]',$detalle->item,['class' => 'form-control','required' ]) !!}
                                    </div>
                                    <div class="col-xs-2">
                                        {!! Form::label('detalle['.$loop->index.'][valor_unitario]', 'Valor Unitario') !!}
                                        {!! Form::number('detalle['.$loop->index.'][valor_unitario]',$detalle->valor_unitario,['id'=>'detalle_'.$loop->index.'_valor_unitario','class' => 'form-control detalle_oc','required','data-row' => $loop->index,'min' => 0]) !!}
                                    </div>
                                    <div class="col-xs-2">
                                        {!! Form::label('detalle['.$loop->index.'][valor_total]', 'Valor Total') !!}
                                        {!! Form::number('detalle['.$loop->index.'][valor_total]',$detalle->valor_total,['id'=>'detalle_'.$loop->index.'_valor_total','class' => 'form-control','readonly','data-row' => $loop->index,'min' => 0]) !!}
                                    </div>
                                    @if($loop->index == 0)
                                        <div class="col-xs-1">
                                            </br><button id="add_detalle_oc" type="button" data-counter="{{count($detalles)}}" class="btn btn-success btn-sm btn-round"><span class="glyphicon glyphicon-plus"></span></button>
                                        </div>
                                    @else
                                        <div class="col-xs-1">
                                            </br><button type="button" data-id="{{$loop->index}}" class="delete_detalle_oc btn btn-danger btn-sm btn-round"><span class="glyphicon glyphicon-minus"></span></button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-4">
                            {!! Form::label('solicita', 'Solicita', ['class' => 'awesome']) !!}
                            {!! Form::text('solicita',$ordenCompra->solicita,['class' => 'form-control','required' ]) !!}
                        </div>
                        <div class="col-xs-4">
                            {!! Form::label('autoriza', 'Autoriza', ['class' => 'awesome']) !!}
                            {!! Form::text('autoriza',$ordenCompra->autoriza,['class' => 'form-control' ,'required']) !!}
                        </div>
                        <div class="col-xs-4">
                            {!! Form::label('revisa', 'revisa', ['class' => 'awesome']) !!}
                            {!! Form::text('revisa',$ordenCompra->revisa,['class' => 'form-control' ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            {!! Form::label('observacion', 'Observacion') !!}
                            {!! Form::textArea('observacion',$ordenCompra->observacion,['class' => 'form-control','rows' => 5]) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
