<html>
    <table>
        <tr>
            <th>Proyecto</th>
            <th>Fecha</th>
            <th>OC</th>
            <th>Proveedor</th>
            <th>Bruto</th>
            <th>IVA</th>
            <th>Valor Neto</th>
            <th>Cot1</th>
            <th>Cot2</th>
            <th>Cot3</th>
            <th>Autorizada</th>
            <th>Facturada</th>
            <th>Fecha Fact</th>
            <th>Comentario</th>
        </tr>
        @foreach($ordenes as $orden)
            <tr>
                <td>{{ $orden['codigo_proyecto' ] }}</td>
                <td>{{ $orden['created_at' ] }}</td>
                <td>{{ $orden['id_orden_compra' ] }}</td>
                <td>{{ $orden['proveedor' ] }}</td>
                <td>{{ $orden['bruto' ] }}</td>
                <td>{{ $orden['iva' ] }}</td>
                <td>{{ $orden['valor_neto' ] }}</td>
                <td>{{ $orden['cotizacion1' ] }}</td>
                <td>{{ $orden['cotizacion2' ] }}</td>
                <td>{{ $orden['cotizacion3' ] }}</td>
                <td>{{ $orden['autorizada' ] }}</td>
                <td>{{ $orden['facturada' ] }}</td>
                <td>{{ $orden['fecha_facturacion' ] }}</td>
                <td>{{ $orden['comentario' ] }}</td>
            </tr>
        @endforeach
    </table>
</html>