$(document).ready(function (e) {
    // $('.select2').select2({
    //     placeholder: "Seleccione"
    // });
    $('#container_grilla_oc').show();
    $('#grilla_oc').html("<img src='/img/gears.gif' alt='Loading...'>");
    $('#grilla_oc').load('/load_grilla_oc');
});
$(function(){
    $('#orden_compra_form').on('submit',function(e){
        $.ajaxSetup({
            header:$('meta[name="_token"]').attr('content')
        })
        e.preventDefault(e);
        $.ajax({
            type:"POST",
            url:'/procesar_oc',
            data:$(this).serialize(),
            dataType: 'json',
            success: function(data){
                console.log(data);
                $("#orden_compra_form").each(function(){ this.reset() });
                $('#container_grilla_oc').show();
                $('#grilla_oc').html("<img src='/img/gears.gif' alt='Loading...'>");
                $('#alert').addClass('alert-success');
                $('#alert').text(data.responseText);
                $('#alert').show();
                $('#grilla_oc').load('/load_grilla_oc');
            },
            error: function(data){
                $('#alert').addClass('alert-danger');
                $('#alert').text(data);
            }
        })
    });
});

