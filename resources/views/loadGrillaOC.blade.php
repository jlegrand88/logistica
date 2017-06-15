<html>
    <head>
        <title>Laravel DataTables</title>
        <link rel="stylesheet" href="plugin/DataTables/dataTables.css">
        <script src="plugin/DataTables/datatables.js"></script>
    </head>
    <body>
        <div class="panel panel-info">
            <!-- Default panel contents -->
            <div class="panel-heading">Lista de Ordenes de Compra</div>
            </br>
            <div class="container-fluid">
                <table id="grilla_ordenes_compra" class="table table-striped table-bordered table-hover dataTable display compact nowrap table-condensed">
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
                </table>
                </br>
                <a href="{{ url('/download_pdf_oc') }}" target="_blank" class="btn btn-info" >Descargar PDF</a>
                </br>
                </br>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                oTable = $('#grilla_ordenes_compra').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "paginate": false,
                    "scrollX": true,
                    "scrollY": 640,
                    "ajax": "{{ route('grilla_oc') }}",
                    "columns": [
                        {data: 'created_at', name: 'Fecha'},
                        {data: 'id_orden_compra', name: 'OC'},
                        {data: 'id_producto', name: 'Producto'},
                        {data: 'cantidad', name: 'Cantidad'},
                        {data: 'cantidad', name: 'Proveedor'},
                        {data: 'valor_neto', name: 'Valor Neto'},
                        {data: 'iva', name: 'IVA'},
                        {data: 'valor_bruto', name: 'Bruto'},
                        {data: 'cotizacion1', name: 'Cot1'},
                        {data: 'cotizacion2', name: 'Cot2'},
                        {data: 'cotizacion3', name: 'Cot3'},
                        {data: 'autorizada', name: 'Autorizada'},
                        {data: 'facturada', name: 'Facturada'},
                        {data: 'updated_at', name: 'Fecha Fact'},
                        {data: 'comentario', name: 'Comentario'}
                    ]
                });
            });
        </script>
    </body>
</html>