@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-info" id="container_grilla_oc">
                    <div class="panel-heading">Lista de Ordenes de Compra</div>
                    <div class="panel-body">
                        <div>
                            {{--<div class="col-sm-2">--}}
                                <a id="btn_add_oc" href="{{ url('/ingresar_oc') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Crear OC</a>
                            {{--</div>--}}
                            {{--<div class="col-sm-2">--}}
                                <button id="btn_upload_cotizacion" type="button" class="btn btn-warning disabled"><span class="glyphicon glyphicon-cloud-upload"></span>  Enlazar Cotización</button>
                            {{--</div>--}}
                            {{--<div class="col-sm-2">--}}
                                <a id="btn_edit_oc" href="{{ url('/editar_oc') }}" class="btn btn-primary disabled"><span class="glyphicon glyphicon-edit"></span> Editar OC</a>
                            {{--BTN ANULAR--}}
                            @if(in_array(\App\Permiso::ANULAR,$permisos))
                                <button id="btn_delete_oc" type="button" class="btn btn-danger disabled"><span class="glyphicon glyphicon-ban-circle"> Anular OC</span></button>
                            @else
                                <div hidden>
                                    <button id="btn_delete_oc" type="button" class="btn btn-danger disabled"><span class="glyphicon glyphicon-ban-circle"> Anular OC</span></button>
                                </div>
                            @endif
                            {{--BTN DESCARGAR PDF--}}
                            {{--@if(in_array(\App\Permiso::DESCARGAR,$permisos))--}}
                                <a id="btn_download_oc" target="_blank" class="btn btn-info disabled" ><span class="glyphicon glyphicon-cloud-download"></span>  Descargar PDF</a>
                            {{--@else--}}
                                {{--<div hidden>--}}
                                    {{--<a id="btn_download_oc" target="_blank" class="btn btn-info disabled" ><span class="glyphicon glyphicon-cloud-download"></span>  Descargar PDF</a>--}}
                                {{--</div>--}}
                            {{--@endif--}}
                            {{-- BTN AUTORIZAR--}}
                            @if(in_array(\App\Permiso::AUTORIZAR,$permisos))
                                <button id="btn_autorizar_oc" type="button" class="btn btn-success disabled"><span class="glyphicon glyphicon-thumbs-up"></span> Autorizar</button>
                            @else
                                <div hidden>
                                    <button id="btn_autorizar_oc" type="button" class="btn btn-success disabled"><span class="glyphicon glyphicon-thumbs-up"></span> Autorizar</button>
                                </div>
                            @endif
                            <a id="btn_download_reporte" target="_blank" class="btn btn-info" href="{{ url('download_reporte') }}"><span class="glyphicon glyphicon-cloud-download"></span> Descargar Reporte</a>
                        </div>
                        <div>
                            <div class="search_column"></div>
                            <div class="search_column"></div>
                            <div class="search_column"></div>
                            <div class="search_column"></div>
                            <div class="search_column"></div>
                            <div class="search_column"></div>
                            <div class="search_column"></div>
                            <div class="search_column"></div>
                            <div class="search_column"></div>
                            <div class="search_column"></div>
                            <div class="search_column"></div>
                            <div class="search_column"></div>
                            <div class="search_column"></div>
                            <div class="search_column"></div>
                        </div>
                        <div id="grilla_oc"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Upload Cotizacion-->
        <div class="modal fade" id="uploadCotizacionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 730px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                        <h4 class="modal-title" id="myModalLabel">Cotización</h4>
                    </div>
                    <div class="modal-body" style="padding: 30px">
                        {!! Form::open(['url' => '/upload_cotizacion', 'files' => true, 'id' => 'upload_cotizacion_form', 'class' => 'form-horizontal']) !!}
                            {!! Form::hidden('cotizacion_id_orden_compra','',['class' => 'form-control','id' => 'cotizacion_id_orden_compra']) !!}
                            <div class="form-group">
                                {!! Form::file('cotizacion1', $attributes = []) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::file('cotizacion2', $attributes = []) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::file('cotizacion3', $attributes = []) !!}
                            </div>
                            {!! Form::submit('Upload',['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
