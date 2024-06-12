
$(document).ready(function () {

    datosforms();
});



function datosforms(){
  

    
    let selectval = $('#seletc_estados').val(); 

    axios.post(principalUrl + "formulariodatos")
    .then((respuesta) => {

        let datosformulario = respuesta.data;
        let frmnuevos = [];
        let sin_estado=0;
        let confirmado=0;
        let no_answer=0;
        let cancelado=0;

        let contador = 0 ;  

    datosformulario.map(item => {

        if(item.estado != 0 && item.form_post_id !=7){

            contador = contador+1;

            if (contador == 95) {
                var nada = "";
            }

            var total_seguimientoform =item.total_seguimiento;
            var fecha_formateada = moment(item.form_date, "YYYY-MM-DD HH:mm:ss").format("ddd DD MMM YYYY hh:mm A");
            frmnuevos.push(item.form_value+";fecha:"+fecha_formateada+";id_forms:"+item.form_id+";total:"+total_seguimientoform+";estado_reg:"+item.estado+";vacio");
        }
        return;
    });


    var datos_limpios = frmnuevos.map(function(form) {
        form = form.slice(6, -1);
    
        var elements = form.split(";");
    
        let cleanData = {};

        var keyestado = elements[7].split(":");
        var estadofiltro = keyestado[keyestado.length - 1].trim().replace(/"/g, '');

        // if (estadofiltro == selectval) {
        
        elements.forEach(function(element,i) {  
            var keyValue = element.split(":");
            var key = keyValue[keyValue.length - 1].trim().replace(/"/g, '');

            if(key == "Nombre"  ){
                var formsiguiente = elements[i+1].split(":");
                var valor = formsiguiente[formsiguiente.length - 1].trim().replace(/"/g, '');
                cleanData[key] = valor;
            }else if(key == "Teléfono" ){
                var formsiguiente = elements[i+1].split(":");
                var valor = formsiguiente[formsiguiente.length - 1].trim().replace(/"/g, '');
                cleanData[key] = valor;
            }else if(key == "estado" ){
                
                var formsiguiente = elements[i+1].split(":");
                var valor = formsiguiente[formsiguiente.length - 1].trim().replace(/"/g, '');
                cleanData[key] = valor;
            }else if(key == "Comentario" ){
                var formsiguiente = elements[i+1].split(":");
                var valor = formsiguiente[formsiguiente.length - 1].trim().replace(/"/g, '');
                cleanData[key] = valor;
            }else if(keyValue[0] == "fecha" ){
                var dato = keyValue[0];
                var valor = keyValue[1].split(" ");
                    valor.pop();
                var ordenado = valor[0]+" "+valor[1]+" "+valor[2]+" "+valor[3];   
                cleanData[dato] = ordenado;
            }else if(keyValue[0] == "total" ){
                var dato = keyValue[0];
                var valor = keyValue[1];
                if(keyValue[1] == ''){
                    valor = 0;
                }
                cleanData[dato] = valor;
            }else if(keyValue[0] == "id_forms" ){
                var dato = keyValue[0];
                var valor = keyValue[1];
                cleanData[dato] = valor;
            }
            else if(keyValue[0] == "estado_reg" ){
                var dato = keyValue[0];
                var valor = keyValue[1];
                let valorformat;
                
                if (valor == "null") {
                    valorformat = "";
                    sin_estado=sin_estado+1;
                } else if(valor == "4") {
                    valorformat = "Confirmado";
                    confirmado=confirmado+1;
                }else if (valor == "5") {
                    valorformat = "No answer";
                    no_answer=no_answer+1;
                }else if (valor == "6") {
                    valorformat = "Cancelado";
                    cancelado=cancelado+1;
                }
                cleanData[dato] = valorformat;
            }
        });
        return cleanData;

    //  }else {
    //     return null; 
    //  }
    }).filter(item => item !== null); 


    // $("#conteo_seminario").find('td:eq(0)').text(sin_estado);
    // $("#conteo_seminario").find('td:eq(1)').text(confirmado);
    // $("#conteo_seminario").find('td:eq(2)').text(no_answer);
    // $("#conteo_seminario").find('td:eq(3)').text(cancelado);
    // var total = sin_estado+confirmado+cancelado+no_answer;

    // $("#conteo_seminario").find('td:eq(4)').text(total);



     tblformulario_seminarios(datos_limpios);

    })
    .catch((error) => {
        if (error.response) {
            console.log(error.response.data);
        }
    });
}



function tblformulario_seminarios(datosFiltrados_seminarios){
    var rol_usuario = $("#rol").val();
   var tblfomrseminario = $("#id_tblclientes").DataTable();
       tblfomrseminario.destroy();

    tblfomrseminario = $("#id_tblclientes").DataTable({
        // language: {
        //     url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
        // },
        lengthChange: false,
        pageLength: 20,
        bInfo: false,
        order: [[0,"desc"]],
        data: datosFiltrados_seminarios,
        columns: [
            { data: 'id_forms',
            width: "100px"},
            { data: 'fecha',
            width: "100px" },
            { data: 'Nombre' ,
            width: "100px" },
            { data: 'Teléfono' ,
            width: "100px" },
            { data: 'estado' ,
            width: "100px" },
            { data: 'Comentario',
            width: "50px" },
            { data: 'estado_reg',
            width: "75px" },
            { data: "total",
                width: "25px",
                className: "text-center",
                render: function (data, type, row) {
                  //  var id_notacita = row['id'];
                    return `<td>
                    <button type="button" class="btn btn-primary">
                    <i class="bi bi-bell bi-3x icono_notas"></i> <span class="badge badge-light">`+data+`</span>
                    <span class="sr-only" style="display:none" >unread messages</span>
                  </button>
                  </td>
                  `;
                },
            },
            { data: "id_forms",
            width: "100px" ,
            render: function (data, type, row) {

                if(rol_usuario === "administrador"){
                return (
                    `<select id="usuario_opcion" onchange="opcionecliente(this,` + data +`
                    , this.closest('tr'))" class="form-control form-select-sm opciones pl-0 pr-0"  placeholder="" style="width: 75% !important;display: initial !important;height: calc(2.05rem + 2px) !important;"><option selected="selected" disabled selected>Acciones</option><option value="1">Seguimiento</option><option value="2">Eliminar</option><option value="4">Confirmado</option><option value="5">No answer</option><option value="6">cancelado</option><option value="3">Bitacora</option>  </select>`
                );
                }else if(rol_usuario === "usuario"){
                    return (
                        `<select id="usuario_opcion" onchange="opcionecliente(this,` + data +`
                        , this.closest('tr'))" class="form-control form-select-sm opciones pl-0 pr-0"  placeholder="" style="width: 75% !important;display: initial !important;height: calc(2.05rem + 2px) !important;"><option selected="selected" disabled selected>Acciones</option><option value="1">Seguimiento</option><option value="4">Confirmado</option><option value="5">No answer</option><option value="6">cancelado</option><option value="3">Bitacora</option>  </select>`
                    );
                }
            }
            },
        ],
    });
}


function opcionecliente(option, id, row) {
    var opt = $(option).val();

    if (opt == 1) {
        lista_seguimientos(id);
        $("#registropre_id").val(id);
        $("#modal_seguimiento").modal("show");
    } else if (opt == 2) {
        var estadoeli = 0;
        Swal.fire({
            title: "Eliminar",
            text: "¿Estas seguro de eliminar el registro?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Continuar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post(principalUrl + "formulariodatos/estado/"+id+"/"+estadoeli)
                    .then((respuesta) => {
                       // datosforms();
                        $(row).hide();

                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Registro eliminado",
                            showConfirmButton: false,
                            timer: 1200,
                        });
                    })
                    .catch((error) => {
                        if (error.response) {
                            console.log(error.response.data);
                        }
                    });
            } else {
            }
        });
    }else if (opt == 3) {

        axios.post(principalUrl + "bitacora/listado/"+id)
        .then((respuesta) => {
            $('#lista_bitacora').html('');

            if(respuesta.data.length === 0){
                Swal.fire({
                    position: "top-center",
                    icon: "info",
                    title: "No tiene bitacoras",
                    showConfirmButton: false,
                });
                return;
            }
            respuesta.data.forEach(function (element) {
                if(element.accion != 'Se creo la cita' || element.accion != 'reagendado'  ){
                    $("#lista_bitacora").append(
                        "<tr class='filas'><td>" +element.name+"</td><td>" + moment(element.fecha, "YYYY-MM-DD hh:mm A").format("DD-MMM-YY")  + "</td><td>" + moment(element.fecha, "YYYY-MM-DD hh:mm A").format("hh:mm A")  + "</td><td>" + element.accion +"</td></tr>"
                    );
                }
            });     
            $("#modal_bitacora_fmr").modal("show");
        })
        .catch((error) => {
            if (error.response) {
                console.log(error.response.data);
            }
        });

    }else if (opt == 4) {
        var num = 4;
        Swal.fire({
            text: "¿Estas seguro de confirmar este registro?",
            showCancelButton: true,
            confirmButtonText: "Continuar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post(principalUrl + "formulariodatos/estado/"+id+"/"+num)
                    .then((respuesta) => {
                        $(row).find('td:eq(6)').text('Confirmado');

                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Registro eliminado",
                            showConfirmButton: false,
                            timer: 1200,
                        });
                    })
                    .catch((error) => {
                        if (error.response) {
                            console.log(error.response.data);
                        }
                    });
            } else {
            }
        });
    }else if (opt == 5) {
        var num = 5;
        Swal.fire({
            text: "¿Quieres marcar como no answer el resgitro?",
            showCancelButton: true,
            confirmButtonText: "Continuar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post(principalUrl + "formulariodatos/estado/"+id+"/"+num)
                    .then((respuesta) => {
                        $(row).find('td:eq(6)').text('No answer');

                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Registro no answer",
                            showConfirmButton: false,
                            timer: 1200,
                        });
                    })
                    .catch((error) => {
                        if (error.response) {
                            console.log(error.response.data);
                        }
                    });
            } else {
            }
        });
    }else if (opt == 6) {
        var num = 6;
        Swal.fire({
            text: "¿Quieres marcar como cancelado el resgitro?",
            showCancelButton: true,
            confirmButtonText: "Continuar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post(principalUrl + "formulariodatos/estado/"+id+"/"+num)
                    .then((respuesta) => {
                        $(row).find('td:eq(6)').text('Cancelado');

                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Registro cancelado",
                            showConfirmButton: false,
                            timer: 1200,
                        });
                    })
                    .catch((error) => {
                        if (error.response) {
                            console.log(error.response.data);
                        }
                    });
            } else {
            }
        });
    }

    $(option).prop("selectedIndex", 0);
}


$('#btnseguimiento').on('click', function() {
    var id = $("#registropre_id").val();
    var datos = new FormData();
    datos.append("id_registro",id); 
    datos.append("txtseguimiento",$("#txtseguimiento").val()); 

    axios.post(principalUrl + "seguimiento/crear", datos)
    .then((respuesta) => {
        $("#txtseguimiento").val("");
        $("#txtseguimiento").focus();
        lista_seguimientos(id);
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Registro creado exitosamente!",
            showConfirmButton: false,
            timer: 1200,
        });
    })
    .catch((error) => {
        if (error.response) {
            console.log(error.response.data);
        }
    });
});

function lista_seguimientos(id){

    axios.post(principalUrl + "seguimiento/listado/" + id)
    .then((respuesta) => {

        respuesta.data
        $("#tblseguimientos").html("");
        respuesta.data.forEach(function (element) {
            $("#tblseguimientos").append(
                "<tr><td>" +element.name +"</td><td>" +moment(element.fecha, "YYYY-MM-DD HH:mm:ss").format("ddd DD MMM YYYY  hh:mm A")+"</td><td>" +element.seguimiento +"</td></tr>"
            );
        });
    })
    .catch((error) => {
        if (error.response) {
            console.log(error.response.data);
        }
    });
}

