<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Listado Ordenes De Compra</title>
        <link rel="stylesheet" href="pdf.css" type="text/css"/>
    </head>
    <body>
        <table>
            <td style="text-align: left;">
                <img src="img/logo_tomate_small.png" alt="logo tomate">
            </td>
            <td style="text-align: right;>
                <img src="img/logo_cenade_small.png" alt="logo tomate">
            </td>
        </table>
        <table class="table table-striped table-bordered table-hover dataTable display compact nowrap table-condensed">
            <thead>
                <th>Fecha</th>
                <th>OC</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Proveedor</th>
                <th>Valor Neto</th>
                <th>IVA</th>
                <th>Bruto</th>
                <th>Cot1</th>
                <th>Cot2</th>
                <th>Cot3</th>
                <th>Autorizada</th>
                <th>Facturada</th>
                <th>Fecha Fact</th>
                <th>Comentario</th>
            </thead>
            <tbody>
                @forelse($ordenes as $orden)
                    <tr>
                        <td>{{ $orden->created_at }}</td>
                        <td>{{ $orden->id_orden_compra }}</td>
                        <td>{{ $orden->id_producto }}</td>
                        <td>{{ $orden->cantidad }}</td>
                        <td>{{ "proveedor" }}</td>
                        <td>{{ $orden->valor_neto }}</td>
                        <td>{{ $orden->iva }}</td>
                        <td>{{ $orden->valor_bruto }}</td>
                        <td>{{ $orden->cotizacion1 }}</td>
                        <td>{{ $orden->cotizacion2 }}</td>
                        <td>{{ $orden->cotizacion3 }}</td>
                        <td>{{ $orden->autorizada }}</td>
                        <td>{{ $orden->facturada }}</td>
                        <td>{{ $orden->updated_at }}</td>
                        <td>{{ $orden->comentario }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13">No existen datos</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </body>
</html>