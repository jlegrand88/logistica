$(document).ready(function (e) {
    $('select').select2({
        placeholder: "Seleccione"
    });
    $('#grilla_oc').html("<img src='/img/gears.gif' alt='Loading...'>");
    $('#grilla_oc').load('/load_grilla_oc');
    $('.dropdown-toggle').dropdown();

    if(!$('#is_new_proveedor').is(':checked'))
    {
        bloquearProveedor();
    }
});

$('#add_detalle_oc').on('click',function(e){
    var countDetalle = $(this).data('counter');
    var element = $(this);
    element.addClass("disabled");
    $.ajax({
        type:"GET",
        url:'/add_detalle_oc',
        data:{row:countDetalle},
        dataType: 'json',
        success: function(data){
            $("#container_detalle_oc").append(data.responseText);
            element.removeClass("disabled");
        }
    });
    countDetalle++;
    $(this).data('counter',countDetalle);
});
$(document).on('click','.delete_detalle_oc', function(e){
    var row = $(this).data('id');
    var countDetalle = $('#add_detalle_oc').data('counter');
    console.log("#detalle_oc_"+row);
    $(this).prop("disabled", true);
    $("#detalle_oc_"+row).remove();
    countDetalle--;
    $('#add_detalle_oc').data('counter',countDetalle);
});
function bloquearProveedor() {
    $("#nombre").attr('readonly',"readonly");
    $("#direccion").attr('readonly',"readonly");
    $("#rut").attr('readonly',"readonly");
    $("#comuna").attr('readonly',"readonly");
    $("#giro").attr('readonly',"readonly");
    $("#email").attr('readonly',"readonly");
    $("#telefono_movil").attr('readonly',"readonly");
    $("#telefono_fijo").attr('readonly',"readonly");
}

$('#is_new_project').on('change',function (e)
{
    $('#codigo_proyecto').val('');
    $('#id_proyecto').val('');
    var isChecked = $(this).is(':checked');
    if(isChecked)
    {
        $('#container_id_proyecto').hide();
        $('#container_codigo_proyecto').show();
        $('#id_proyecto').removeAttr('required');
        $('#codigo_proyecto').attr('required',true);
    }else{
        $('#container_id_proyecto').show();
        $('#id_proyecto').select2({
            placeholder: "Seleccione"
        });
        $('#id_proyecto').attr('required',true);
        $('#codigo_proyecto').removeAttr('required');
        $('#container_codigo_proyecto').hide();
    }
});
$('#is_new_proveedor').on('change',function (e)
{
    cleanProveedor();
    $('#id_proveedor').val('');
    var isChecked = $(this).is(':checked');
    if(isChecked)
    {
        $('#container_id_proveedor').hide();
        $('#id_proveedor').removeAttr('required');
        $("#nombre").removeAttr('readonly');
        $("#direccion").removeAttr('readonly');
        $("#rut").removeAttr('readonly');
        $("#comuna").removeAttr('readonly');
        $("#giro").removeAttr('readonly');
        $("#email").removeAttr('readonly');
        $("#telefono_movil").removeAttr('readonly');
        $("#telefono_fijo").removeAttr('readonly');
    }
    else
    {
        $('#container_id_proveedor').show();
        $('#id_proveedor').attr('required',true);
        $('#id_proveedor').select2({
            placeholder: "Seleccione"
        });
        bloquearProveedor();
    }
});

$(document).on('change','.detalle_oc',function (e)
{
    var row = $(this).data('row');
    var total = $('#detalle_'+row+'_cantidad').val() * $('#detalle_'+row+'_valor_unitario').val();
    console.log($('#detalle_'+row+'_cantidad').val());
    $('#detalle_'+row+'_valor_total').val(total);
});

$('#id_proveedor').on('change',function (e) {
    var idProveedor = $(this).val();
    if(!idProveedor)
    {
        cleanProveedor();
    }
    else
    {
        $.ajax({
            type: "GET",
            url: '/load_proveedor',
            data: {id: idProveedor},
            dataType: 'json',
            success: function (data) {
                var obj = data.responseText;
                $("#nombre").val(obj.nombre);
                $("#direccion").val(obj.direccion);
                $("#rut").val(obj.rut);
                $("#comuna").val(obj.comuna);
                $("#giro").val(obj.giro);
                $("#email").val(obj.email);
                $("#telefono_movil").val(obj.telefono_movil);
                $("#telefono_fijo").val(obj.telefono);
            }
        });
    }
});

function cleanProveedor() {
    $("#nombre").val('');
    $("#direccion").val('');
    $("#rut").val('');
    $("#comuna").val('');
    $("#giro").val('');
    $("#email").val('');
    $("#telefono_movil").val('');
    $("#telefono_fijo").val('');
}
