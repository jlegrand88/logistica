<html>
    <head>
        <title>Laravel DataTables</title>
        <link rel="stylesheet" href="DataTables/dataTables.css">
    </head>
    <body>
        </br>
        <div class="container-fluid">
            <table id="grilla_ordenes_compra" class="table table-striped table-bordered table-hover dataTable display compact nowrap table-condensed">
                <thead>
                    <th>Fecha</th>
                    <th>OC</th>
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
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                var spanish = {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "select": {
                        "rows": "<span></br>%d filas seleccionadas<span>"
                    }
                };
                var oTable = $('#grilla_ordenes_compra').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "paginate": true,
                    "scrollX": true,
                    "scrollY": 450,
                    "language": spanish,
                    "select" : {style: 'single',items: 'row'},
                    "ajax": "{{ route('grilla_oc') }}",
                    "columns": [
                        {data: 'created_at', name: 'Fecha'},
                        {data: 'id_orden_compra', name: 'OC'},
                        {data: 'proveedor', name: 'Proveedor'},
                        {data: 'valor_neto', name: 'Valor Neto'},
                        {data: 'iva', name: 'IVA'},
                        {data: 'bruto', name: 'Bruto'},
                        {data: 'cotizacion1', name: 'Cot1'},
                        {data: 'cotizacion2', name: 'Cot2'},
                        {data: 'cotizacion3', name: 'Cot3'},
                        {data: 'autorizada', name: 'Autorizada'},
                        {data: 'facturada', name: 'Facturada'},
                        {data: 'fecha_facturacion', name: 'Fecha Fact'},
                        {data: 'comentario', name: 'Comentario'}
                    ]
//                    "columnDefs":[{targets: [0], visible: false, searchable: false}]
                });
                oTable.on( 'select', function (e, dt, type, indexes) {
                    if ( type === 'row' )
                    {
                        var fila = indexes;
                        var data = oTable.rows( indexes ).data()[0];
                        console.log(data);
                        $('#btn_edit_oc').data('id',data.id_orden_compra);
                        $('#btn_edit_oc').removeClass('disabled');
                        $('#btn_delete_oc').data('id',data.id_orden_compra);
                        $('#btn_delete_oc').removeClass('disabled');
                        $('#btn_upload_cotizacion').data('id',data.id_orden_compra);
                        $('#btn_upload_cotizacion').removeClass('disabled');
                        $('#btn_download_oc').data('id',data.id_orden_compra);
                        $('#btn_download_oc').removeClass('disabled');
                        $('#btn_download_oc').attr('href',"{{ url('/download_pdf_oc') }}?id="+data.id_orden_compra);
                        $('#btn_autorizar_oc').data('id',data.id_orden_compra);
                        $('#btn_autorizar_oc').removeClass('disabled');
                    }
                } );
                oTable.on( 'deselect', function (e, dt, type, indexes) {
                    resetBtnsMovimientos();
                } );
            });
            function resetBtnsMovimientos() {
                $('#btn_edit_oc').data('id','');
                $('#btn_edit_oc').addClass('disabled');
                $('#btn_delete_oc').data('id','');
                $('#btn_delete_oc').addClass('disabled');
                $('#btn_upload_cotizacion').data('id','');
                $('#btn_upload_cotizacion').addClass('disabled');
                $('#btn_download_oc').data('id','');
                $('#btn_download_oc').addClass('disabled');
                $('#btn_download_oc').attr('href',"");
                $('#btn_autorizar_oc').data('id','');
                $('#btn_autorizar_oc').addClass('disabled');
            }

            $('#btn_delete_oc').on('click',function (e) {
                var idOC = $(this).data('id');
                resetBtnsMovimientos();
                $('#grilla_oc').html("<img src='/img/gears.gif' alt='Loading...'>");
                $.ajax({
                    type: "GET",
                    url: '/delete_oc',
                    data: {id: idOC},
                    dataType: 'json',
                    success: function (data) {
                        $('#grilla_oc').load('/load_grilla_oc');
                        $('.dropdown-toggle').dropdown();
                    }
                });
            });

            $('#btn_autorizar_oc').on('click',function (e) {
                var idOC = $(this).data('id');
                resetBtnsMovimientos();
                $('#grilla_oc').html("<img src='/img/gears.gif' alt='Loading...'>");
                $.ajax({
                    type: "GET",
                    url: '/autorizar_oc',
                    data: {id: idOC},
                    dataType: 'json',
                    success: function (data) {
                        $('#grilla_oc').load('/load_grilla_oc');
                        $('.dropdown-toggle').dropdown();
                    }
                });
            });

            $('#btn_upload_cotizacion').on('click',function (e) {
                var idOC = $(this).data('id');
                console.log(idOC);
                resetBtnsMovimientos();
                $('#cotizacion_id_orden_compra').val(idOC);
                $('#uploadCotizacionForm').modal('show');

            });
        </script>
    </body>
</html>