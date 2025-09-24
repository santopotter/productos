$(document).ready(function() {

    $.getJSON('php/obtener_bodegas.php')
        .done(function(data){
            let select = $('#bodega');
            $.each(data, function(i, b){
                select.append(`<option value="${b.id_bodega}">${b.nombre_bodega}</option>`);
            });
        })
        .fail(function(err){
            console.error("Error cargando bodegas:", err.responseText || err);
        });

    $.getJSON('php/obtener_moneda.php')
        .done(function(data){
            let select = $('#moneda');
            $.each(data, function(i, m){
                select.append(`<option value="${m.id_moneda}">${m.nombre_moneda}</option>`);
            });
        })
        .fail(function(err){
            console.error("Error cargando monedas:", err.responseText || err);
        });

$('#bodega').on('change', function(){
    let idBodega = $(this).val();
    let select = $('#sucursal');
    select.empty(); // vaciamos todo

    // ✅ agregamos primera opción en blanco
    select.append('<option value=""></option>');

    if(idBodega){
        $.getJSON('php/obtener_surcursales.php', {id_bodega: idBodega}, function(data){
            $.each(data, function(i, s){
                select.append(`<option value="${s.id_sucursal}">${s.nombre_sucursal}</option>`);
            });
        }).fail(function(err){
            console.error("Error cargando sucursales:", err.responseText || err);
        });
    }
});

    $('#formProducto').on('submit', function(e){
        e.preventDefault();

        const codigo = $('#codigo').val().trim();
        const nombre = $('#nombre').val().trim();
        const bodega = $('#bodega').val();
        const sucursal = $('#sucursal').val();
        const moneda = $('#moneda').val();
        const precio = $('#precio').val().trim();
        let materiales = $('input[name="materiales[]"]:checked').length;

        const descripcion = $('#descripcion').val().trim();

        if(!/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,15}$/.test(codigo)){ alert("Código inválido"); return; }
        if(nombre.length<2 || nombre.length>50){ alert("Nombre inválido"); return; }
        if(!bodega){ alert("Seleccione bodega"); return; }
        if(!sucursal){ alert("Seleccione sucursal"); return; }
        if(!moneda){ alert("Seleccione moneda"); return; }
        if(!/^\d+(\.\d{1,2})?$/.test(precio)){ alert("Precio inválido"); return; }
        if(materiales<2){ alert("Seleccione al menos 2 materiales"); return; }
        if(descripcion.length<10 || descripcion.length>1000){ alert("Descripción inválida"); return; }

        let formData = new FormData(this);

        $.ajax({
            url: 'php/guardar_producto.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data){
                if(data.message){
                    alert(data.message);
                    $('#formProducto')[0].reset();
                    $('#sucursal').empty().append('<option value=""></option>');
                }
            },
            error: function(err){
                console.error("Error guardando producto:", err.responseText || err);
                alert("Error al guardar el producto.");
            }
        });
    });

});
