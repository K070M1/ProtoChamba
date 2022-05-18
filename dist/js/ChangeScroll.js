
// Carga de usuarios en reportes
function scrollReportingData(){
    var scrollTop = $("#scrollReportingUser").scrollTop(); //Posicion en el que se encuentra el elemento
    var scrollHeight = $("#scrollReportingUser").prop('scrollHeight'); //ALtura total del elemento scrolleable
    var offsetHeight = $("#scrollReportingUser").prop('offsetHeight'); // ALtura que se esta viendo
    var contentHeigh = scrollHeight - offsetHeight; // Altura del elemento
    // 0 es el inicio // (valor maximo) es el punto final
    if((contentHeigh <= scrollTop) && !wall){
        var countReport = '10';
        page = Number(lastpage) + 1;
        lastpage = Number(page) + Number(countReport);
        dataSendController['op'] = 'searchUsersByNamesViewHistory'
        dataSendController['start'] = page;
        dataSendController['finish'] = countReport;
        $.ajax({
            url: 'controllers/user.controller.php',
            type: 'GET',
            data: dataSendController,
            success: function (e) {
                var errorval = 'No se encontraron registros';
                var encon = e.includes(errorval);
                if(encon){
                    wall = true;
                }else{
                    setTimeout(() => {
                        $("#tbody-users").append(e);
                        wall = false;
                    }, 500);  
                }
            }
        });
    }
}

// Para que no se cargue a partir de que se encuentre en ese nav
$("#nav-configuracion-tab").click(function(){
    wservicepublic = false;
});

// Cargar de publicaciones de los servicios
$(window).on("scroll", function(){
    if(typeof wservicepublic !== "undefined"){
        var scrollHeightDocument = $(document).height();
        var scrollPos = $(window).height() + $(window).scrollTop();
        if(scrollHeightDocument <= scrollPos && !wwall && !wservicepublic){
            var Workcount = '3';
            wpage = Number(wlastpage) + 1 ;
            wlastpage = Number(wpage) +  Number(Workcount);
    
            dataenv = {
                'op':'getWorksByUser',
                'idusuarioactivo': idusuarioActivo,
                'start': wpage,
                'finish': Workcount
            };
            $.ajax({
                url: 'controllers/work.controller.php',
                type: 'GET',
                data: dataenv,
                success: function(e){
                    var errorval = 'No existen publicaciones';
                    var encon = e.includes(errorval);
                    if(encon){
                        wpage = '0';
                        wlastpage = Number(wlastpage) - 4;
                        wwall = true;
                    }else{
                        setTimeout(() => {
                            $("#data-publication-works").append(e);
                            wwall = false;
                        }, 500);  
                    }
                }
            });
        }
    }
});

// Carga de comentarios de foro
function scrollForoComments(){
    var scrollTop = $("#content-data-forum").scrollTop(); //Posicion en el que se encuentra el elemento
    var scrollHeight = $("#content-data-forum").prop('scrollHeight'); //ALtura total del elemento scrolleable
    var offsetHeight = $("#content-data-forum").prop('offsetHeight'); // ALtura que se esta viendo
    var contentHeigh = scrollHeight - offsetHeight; // Altura del elemento
    if((contentHeigh <= scrollTop) && !fwall){
        var count = '5';
        fpage = Number(flastpage) + 1;
        flastpage = Number(fpage) + Number(count);
        
        fdataenv = {
            'op':'getQueriesToUser',
            'idusuarioactivo': idusuarioActivo,
            'start': fpage,
            'finish': count
        };

        $.ajax({
            url: 'controllers/forum.controller.php',
            type: 'GET',
            data: fdataenv,
            success: function (e) {
                let errorval = 'Sin consultas';
                let encon = e.includes(errorval);
                if(encon){
                    fpage = '0';
                    flastpage = Number(flastpage) - 6;
                    fwall = true;
                }else{
                    setTimeout(() => {
                        $("#content-data-forum").append(e);
                        fwall = false;
                    }, 500);  
                }
            }
        });
    }
}
