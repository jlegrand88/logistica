<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Listado Ordenes De Compra</title>
        <link rel="stylesheet" href="/css/pdf.css" type="text/css"/>
        {{--<link rel="stylesheet" href="/css/app.css" type="text/css"/>--}}
    </head>
    <body>
        <table>
            <tr>
                <td style="text-align: left;">
                    <img src="img/logo_tomate_small.png" alt="logo tomate">
                </td>
                <td>
                    <table class="table_head">
                        <tr>
                            <td> Dirección: </td>
                            <td class="column_head"> xxxxxxxxxx </td>
                            <td> Demandante: </td>
                            <td> <b>TÓMATE</b> </td>
                        </tr>
                        <tr>
                            <td> Télefono: </td>
                            <td class="column_head"> xxxxxxxxxx </td>
                            <td> Fecha Orden Compra: </td>
                            <td> <b><?php echo $ordenCompra->created_at->format('d-m-Y'); ?></b> </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="row_oc" style="width: 100%;">
            <tr>
                <td style="padding-right: 50px;"><b>OT N°: <?php echo $ordenCompra->id_proyecto; ?></b></td>
                <td><b>ORDEN COMPRA</b>(Menor a 3 UTM): <b>N°</b> <?php echo $ordenCompra->id_proyecto; ?></td>
            </tr>
        </table>
        <table style="width:100%;border: 5px black solid; border-collapse: collapse; margin-top: 10px;">
            <tr>
                <td>
                    <table >
                        <tr>
                            <td>Señor (es):</td><td> <?php echo $proveedor->nombre; ?></td>
                        </tr>
                        <tr>
                            <td>Dirección:</td><td> <?php echo $proveedor->direccion; ?></td>
                        </tr>
                        <tr>
                            <td>Rut:</td><td> <?php echo $proveedor->rut; ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td><td> <?php echo $proveedor->email; ?></td>
                        </tr>
                        <tr>
                            <td>Télefono:</td><td> <?php echo $proveedor->telefono; ?></td>
                        </tr>
                            <?php if($proveedor->telefono_movil): ?>
                            <tr>
                                <td>Télefono Movil:</td><td> <?php echo $proveedor->telefono_movil; ?></td>
                            </tr>
                            <?php endif; ?>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table style="width:100%;border: 5px black solid; border-collapse: collapse; margin-top: 10px;">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td><b>FORMA DE PAGO:</b></td><td> <?php echo $tipoPago; ?></td>
                        </tr>
                        <tr>
                            <td><b>EMITIDA POR:</b></td><td> <?php echo $proveedor->direccion; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table style="width:100%; border-collapse: collapse; margin-top: 10px;">
            <thead>
                <tr style="border: 5px black solid;">
                    <th style="border: 5px black solid;">CANTIDAD</th>
                    <th style="border: 5px black solid;">DESCRIPCIÓN DEL PRODUCTO</th>
                    <th style="border: 5px black solid;">PRECIO</th>
                    <th style="border: 5px black solid;">VALOR</th>
                </tr>
            </thead>
            <colgroup span="1"></colgroup>
            <colgroup span="1"></colgroup>
            <colgroup span="1"></colgroup>
            <colgroup span="1"></colgroup>
            <tbody style="border: 5px black solid;">
                <?php $subTotal = 0; ?>
                @forelse($detalles as $detalle)
                    <tr style="border: 5px black solid;">
                        <td style="border-right: 5px black solid;text-align: right;">{{ $detalle->cantidad }}</td>
                        <td style="border-right: 5px black solid;text-align: left;">{{ $detalle->item }}</td>
                        <td style="border-right: 5px black solid;text-align: right;">{{ $detalle->valor_unitario }}</td>
                        <td style="border-right: 5px black solid;text-align: right;">{{ $detalle->valor_total }}</td>
                    </tr>
                    <?php $subTotal = $detalle->valor_total + $subTotal; ?>
                @empty
                    <tr>
                        <td colspan="4">No existen datos</td>
                    </tr>
                @endforelse
            </tbody>
                <tr>
                    <td  colspan="2" style="border:0px !important;">
                    </td>
                    <td style="border: 5px black solid;">
                        <table>
                            <tr>
                                <td>Neto</td>
                            </tr>
                            <tr>
                                <td>IVA</td>
                            </tr>
                            <tr>
                                <td><b>Total</b></td>
                            </tr>
                        </table>
                    </td>
                    <td style="border: 5px black solid;">
                        <table>
                            <tr>
                                <td>{{$subTotal}}</td>
                            </tr>
                            <tr>
                                <td>{{$subTotal*0.19}}</td>
                            </tr>
                            <tr>
                                <td>{{$subTotal*1.19}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
        </table>
        <table>
            <tr>
                <td><b>Observaciones:</b></td>
                <td>{{$ordenCompra->observacion}}</td>
            </tr>
        </table>
    </body>
</html>