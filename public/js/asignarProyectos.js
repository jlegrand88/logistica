$('#id_proyecto').on('change',function () {
    $('#container_usuarios').html("<img src='/img/loading.gif' alt='Loading...'>");
    $.ajax({
        type: "GET",
        url: '/load_usuarios_asignados',
        data: {id_proyecto: $(this).val()},
        dataType: 'json',
        success: function (data) {
            var obj = data.responseText;
            $('#container_usuarios').html(obj);
            $('#usuarios').select2();
        }
    });
});
