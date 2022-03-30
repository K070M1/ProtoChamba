class Localizacion{
  
  constructor(callback){
    if(navigator.geolocation){
      // Notificación
      navigator.geolocation.getCurrentPosition((position) =>{
        this.latitude = position.coords.latitude;
        this.longitud = position.coords.longitude;

        callback();
      })
    }
    else{
      alert("No soporta geolocalización");
    }
  }
}

const cities = {
  type: "FeatureCollection",
  features: [
    {
      type: "Feature",
      geometry: { type: "Point", coordinates: [-87.65, 41.85] },
      properties: { name: "Chicago" },
    },
    {
      type: "Feature",
      geometry: { type: "Point", coordinates: [-149.9, 61.218] },
      properties: { name: "Anchorage" },
    },
    {
      type: "Feature",
      geometry: { type: "Point", coordinates: [-99.127, 19.427] },
      properties: { name: "Mexico City" },
    },
    {
      type: "Feature",
      geometry: { type: "Point", coordinates: [-0.126, 51.5] },
      properties: { name: "London" },
    },
    {
      type: "Feature",
      geometry: { type: "Point", coordinates: [28.045, -26.201] },
      properties: { name: "Johannesburg" },
    },
    {
      type: "Feature",
      geometry: { type: "Point", coordinates: [15.322, -4.325] },
      properties: { name: "Kinshasa" },
    },
    {
      type: "Feature",
      geometry: { type: "Point", coordinates: [151.207, -33.867] },
      properties: { name: "Sydney" },
    },
    {
      type: "Feature",
      geometry: { type: "Point", coordinates: [0, 0] },
      properties: { name: "0°N 0°E" },
    },
  ],
};

function initMap(){
  const ubicacion = new Localizacion(()=>{
    const myLatLng = {lat: ubicacion.latitude, lng: ubicacion.longitud};
    var texto = '<h1>Nombre del lugar</h1>' + '<p>Descripción del lugar</p>' +
                '<a href="https://www.google.com">pagina web</a>';

    const options = {
      center:{
        lat: ubicacion.latitude, 
        lng: ubicacion.longitud
      },
      zoom: 5,
      heading: 90,
      tilt: 45,
      //mapTypeId: 'satellite'
    }

    var map = document.getElementById('map');
    var autocomplete = document.getElementById('autocompletado');

    const mapa = new google.maps.Map(map, options);
    mapa.setMapTypeId('terrain');

    // Marcadores
    var marker1 = new google.maps.Marker({
      position: options.center, 
      map: mapa, 
      title: 'Markador 1',
      draggable: false    
    });

    var info = new google.maps.InfoWindow({
      content: texto
    });

    marker1.addListener('click', function (){
      info.open(mapa, marker1)
    })

    var marker2 = new google.maps.Marker({
      position: {
        lat: -13.4255087, 
        lng: -76.1454658
      }, 
      map: mapa, 
      title: 'Markador 2',
      draggable: true    
    });

    marker2.addListener('click', function (){
      info.open(mapa, marker2)
    })
  });
}

function iniciarMap(){
  var coord = {lat:-34.5956145 ,lng: -58.4431949};
  var map = new google.maps.Map(document.getElementById('map'),{
    zoom: 10,
    center: coord
  });
  
  var marker = new google.maps.Marker({
    position: coord,
    map: map
  });
}