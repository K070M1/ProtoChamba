$('#search-servicio').click(function() {
    startMap();
})

var template = String($('#lista-establecimientos').html());
var establecimientosInfo = [];
var directionsDisplay;
var miubicacion = {};
var mapa;
var nombreciudad = '';
const g_key = 'AIzaSyCyBhbKb3BeyxJ-BBV9bsv0nA61dVbpA6E';

// deg = Grados (Latitud, Longitud)
function deg2rad(deg) {
    return deg * (Math.PI / 180)
}

// lat1, lon1 = Mi ubicación
// lat2, lon2 = Establecimiento
// R = radio de la tierra
// C = Distancia entre el A y el punto B
// D = Distancia
function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
    var R = 6371;
    var dLat = deg2rad(lat2 - lat1);
    var dLon = deg2rad(lon2 - lon1);
    var a =
        (Math.sin(dLat / 2) * 2) + 
        Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
        (Math.sin(dLon / 2) * 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a)); 
    var d = R * c;
    if (d >= 1) {
        return '(' + (Math.round(d * 100) / 100) + " km)";
    } else if (d < 1) {
        return '(' + Math.round(d * 1000) + " m)";
    } else {
        return '';
    };
}

function startMap() {
    initAutocomplete();
    var nombreservicio = $('#servicio-buscado').val();
    $.ajax({
        url: 'controllers/establishment.controller.php',
        type: 'GET',
        dataType: 'JSON',
        data: {
            'op': 'getEstablishmentByService',
            'nombreservicio': nombreservicio,
            'nombreciudad': nombreciudad
        },
        success: establecimientos => {
            $('#lista-establecimientos').empty();
            establecimientosInfo = [];
            establecimientos.forEach(establecimiento => {
                let establecimientoInfo = {
                    id: establecimiento.idestablecimiento,
                    posicion: {
                        lat: parseFloat(establecimiento.latitud),
                        lng: parseFloat(establecimiento.longitud)
                    },
                    nombre: establecimiento.establecimiento
                };
                establecimientosInfo.push(establecimientoInfo);

                // MOSTRAR ESTABLECIMIENTOS
                var e_template = template;
                for (key in establecimiento) {
                    e_template = e_template.replaceAll('{' + key + '}', establecimiento[key]);
                }
                $('#lista-establecimientos').append(e_template);
                $(`#${establecimiento.idestablecimiento}`).attr('data-establecimiento', JSON.stringify(establecimiento));
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    miPosicion => {
                        miubicacion = {
                            lat: miPosicion.coords.latitude,
                            lng: miPosicion.coords.longitude
                        }
                        drawMap(miubicacion);
                    },
                    function (error) {                        
                        $.ajax({
                            url: `https://www.googleapis.com/geolocation/v1/geolocate?key=${g_key}`,
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                'considerIp': 'true',
                                'fields': 'location',
                                'location': 'true',
                                'accuracy': 'true',
                                'altitude': 'true',
                                'altitudeAccuracy': 'true',
                                'heading': 'true',
                                'speed': 'true'
                            },
                            success: data => {
                                miubicacion = {
                                    lat: data.location.lat,
                                    lng: data.location.lng
                                }
                                drawMap(miubicacion);
                            },
                            error: e => {
                                miubicacion = {
                                    lat: -12.046374,
                                    lng: -77.042793
                                }
                                drawMap(miubicacion);
                            }
                        })
                    }
                )
            }
        }
    })
}


function drawMap(obj) {
    $('#detalle-recorrido').hide();
    let div = document.getElementById('primary-map');
    mapa = new google.maps.Map(div, {
        center: obj,
        zoom: 7
    });

    let marcadorUsuario = new google.maps.Marker({
        position: obj,
        title: 'Mi ubicación',
        map: mapa
    })
    // cambiar el color del marcador de usuario
    marcadorUsuario.setIcon('dist/img/marker/userMarker.png');

    let marcadores = establecimientosInfo.map(lugar => {
        $(`#${lugar.id} #distancia`).text(getDistanceFromLatLonInKm(obj.lat, obj.lng, lugar.posicion.lat, lugar.posicion.lng));
        return new google.maps.Marker({
            id: lugar.id,
            position: lugar.posicion,
            title: lugar.nombre,
            map: mapa
        })
    })

    // Colocar información en los marcadores
    marcadores.forEach(marcador => {
        marcador.setIcon('dist/img/marker/otherMarker.png');
        let establecimiento = JSON.parse($(`#${marcador.id}`).attr('data-establecimiento'));
        // obtener la direccion del marcador segun google maps
        let geocoder = new google.maps.Geocoder;
        let infowindow = new google.maps.InfoWindow;
        geocoder.geocode({
            'location': marcador.position
        }, (results, status) => {
            if (status === 'OK') {
                if (results[0]) {
                    let direccion = results[0].formatted_address;
                    let distancia = getDistanceFromLatLonInKm(obj.lat, obj.lng, marcador.position.lat(), marcador.position.lng());
                    let contentString = `
                    <div class="card m-0">
                        <div class="card-body">
                            <h5 class="card-title">${establecimiento.establecimiento} a ${distancia}</h5>
                            <p class="card-text">${direccion}</p>
                            <p class="card-text">${establecimiento.horarioatencion}</p>
                            <a href="tel:${establecimiento.telefono}" class="btn btn-sm btn-success">
                                <i class="fas fa-phone"></i>
                                Llamar
                            </a>
                            <button class="btn btn-sm btn-primary">
                                <i class="fa fa-user"></i>
                                Ver perfil
                            </button>
                        </div>
                    </div>`;
                    infowindow.setContent(contentString);
                    marcador.addListener('click', function () {
                        infowindow.open(mapa, marcador);
                    })
                } else {
                   // window.alert('No se encontró ningún resultado');
                }
            } else {
                //window.alert('Geocoder falló debido a: ' + status);
            }
        })
    })
}

function drawRoute(ubicacionDestino) {
    if (directionsDisplay) {
        directionsDisplay.setMap(null);
    }
    let directionsService = new google.maps.DirectionsService();
    directionsDisplay = new google.maps.DirectionsRenderer();
    directionsDisplay.setMap(mapa);
    directionsService.route({
        origin: miubicacion,
        destination: ubicacionDestino,
        travelMode: $('#tipo-recorrido').val()
    }, function (response, status) {
        if (status === 'OK') {
            directionsDisplay.setDirections(response);
            // otener la distancia y tiempo
            let distancia = response.routes[0].legs[0].distance.text;
            let tiempo = response.routes[0].legs[0].duration.text;
            $('#detalle-recorrido').show();
            $('#distancia .text').text(distancia);
            $('#tiempo .text').text(tiempo);
        } else {
            //window.alert('Directions request failed due to ' + status);
        }
    });
}

$(document).on('click', '#trazar-ruta', function () {
    var data = JSON.parse($(this).parents('.establecimiento-info').attr('data-establecimiento'));
    $('#modal-ruta').modal('show').attr('data-establecimiento', JSON.stringify(data));
})

$(document).on('click', '#btn-ruta', function () {
    var data = JSON.parse($('#modal-ruta').attr('data-establecimiento'));
    var ubicacionDestino = {
        lat: parseFloat(data.latitud),
        lng: parseFloat(data.longitud)
    };
    drawRoute(ubicacionDestino);
    $('#modal-ruta').modal('hide');
})

$(document).on('click', '#btn-add-filter', function () {
    $('#filter-container').toggle(125);
    $('#ciudad-buscada').val('');
    nombreciudad = '';
})

let autocomplete;
function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('ciudad-buscada'), {
            types: ['(cities)'],
            componentRestrictions: {
                country: 'pe'
            }
        });
    autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
    var place = autocomplete.getPlace();
    nombreciudad = place.name;
    startMap();
}