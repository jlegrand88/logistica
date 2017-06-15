@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <ul class="nav nav-pills">
                <li role="presentation" class="active"><a href="{{ url('/ingresar_oc') }}">Ingresar OC</a></li>
                </ul>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="panel panel-default">
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
                            <form id="orden_compra_form" action="{{ url('/procesar_oc') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    {{--PRODUCTO--}}
                                    <div class="form-group col-sm-4">
                                        <label for="id_producto">Producto:</label>
                                        <select class="form-control input-sm selec2" id="id_producto" name="id_producto" required placeholder="Seleccione...">
                                            <option value="">Seleccione</option>
                                            <option value="1">test</option>
                                        </select>
                                    </div>
                                    {{--CANTIDAD--}}
                                    <div class="form-group col-sm-4">
                                        <label for="cantidad">Cantidad:</label>
                                        <input name="cantidad" class="form-control input-sm" required="true" size="150" maxlength="45" type="number">
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    {{--VALOR NETO--}}
                                    <div class="form-group col-sm-4">
                                        <label for="valor_neto">Valor Neto:</label>
                                        <input name="valor_neto" id="valor_neto" class="form-control input-sm" required="true" size="150" maxlength="45" type="number">
                                    </div>
                                    {{--VALOR BRUTO--}}
                                    <div class="form-group col-sm-4">
                                        <label for="valor_bruto">Valor Bruto:</label>
                                        <input name="valor_bruto" id="valor_bruto" class="form-control input-sm" required="true" size="150"  maxlength="45" type="number">
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    {{--COTIZACION 1--}}
                                    <div class="form-group col-sm-4">
                                        <label for="producto">Cotización 1:</label>
                                        <input name="cotizacion_1" id="cotizacion_1" class="form-control input-sm" required="true" size="150"  maxlength="45" type="number">
                                    </div>
                                    {{--COTIZACION 2--}}
                                    <div class="form-group col-sm-4">
                                        <label for="producto">Cotización 2:</label>
                                        <input name="cotizacion_2" id="cotizacion_2" class="form-control input-sm" required="true" size="150" maxlength="45" type="number">
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    {{--COTIZACION 3--}}
                                    <div class="form-group col-sm-4">
                                        <label for="cotizacion_3">Cotización 3:</label>
                                        <input name="cotizacion_3" id="cotizacion_3" class="form-control input-sm" required="true" size="150" maxlength="45" type="number">
                                    </div>
                                    {{--IVA--}}
                                    <div class="form-group col-sm-4">
                                        <label for="iva">IVA:</label>
                                        <input name="iva" id="iva" class="form-control input-sm" required="true" size="150" min="0" max="100" type="number" >
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    {{--AUTORIZADA--}}
                                    <div class="form-group col-sm-4">
                                        <label for="autorizada">Autorizada:</label>
                                        <input name="autorizada" id="autorizada" class="form-control input-sm" required="true" size="150" maxlength="45" type="text">
                                    </div>
                                    {{--FACTURADA--}}
                                    <div class="form-group col-sm-4">
                                        <label for="facturada">Facturada:</label>
                                        <select class="form-control input-sm selec2" id="facturada" name="facturada" placeholder="Seleccione" required>
                                            <option value="">Seleccione</option>
                                            <option value="1">Si</option>
                                            <option value="1">no</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                                <div class="row">
                                    {{--comentario--}}
                                    <div class="col-sm-2"></div>
                                    <div class="form-group col-sm-8">
                                        <label for="autorizada">Comentario:</label>
                                        <textarea name="comentario" id="comentario" class="form-control input-sm" required="true" rows="2" cols="30" max_length="100" maxlength="100">
                                        </textarea>
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                                <div class="row text-center">
                                    <button id="bnt_submit_orden_compra" type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="panel panel-default" id="container_grilla_oc" hidden>
                        <div class="panel-body">
                            <div id="grilla_oc"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
