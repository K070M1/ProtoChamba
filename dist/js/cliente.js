// Instancia del websocket WS:IP:PORT
var socket = new WebSocket('ws://localhost:8080');

// Conexión abierta
socket.onopen = function () {
  console.log("Conexión éxitosa");
};

// Mensaje obtenida
socket.onmessage = function (result) {
  let operation = result.data;

  // Recargar datos del usuario
  if(operation == "loadDataPerson"){
    listDataUser();
    listInfo();
    loadNameUser();
  }

  // Actualizar el listado de usuarios
  if(operation == "users"){
    loadUsersTable();
  }

  // Imagen de portada
  if(operation == "imageport"){
    loadPicturePort();
  }

  // Imagen de perfil
  if(operation == "imageprofile"){
    loadPicturePerfil();
  }

  // Recargar especialidades del usuario
  if(operation == "especialties"){
    loadEspecialties();
    //serviceRecommendationCarousel();
  }

  // Recargar info de establecimientos
  if(operation == "establishment"){
    listEstablishment();
    listInfo();
  }

  // Recargar descripción del usuario
  if(operation == "description"){
    descripcion();
  }

  // Recargar redes sociales del usuario
  if(operation == "redsocial"){
    listRedSocial();
  }

  // Recargar galerias
  if(operation == "gallery"){
    loadAlbum();
    loadGallery();
    loadPicturePerfil();
  }

  // Recargar galerias
  if(operation == "follower"){
    validateFollower();
    listFollower();
    listFollowing();
    countFollower();
    countFollowing();
  }

  // Recargar publicaciones
  if(operation == "publicationwork"){
    cleanContainerPublication();
    loadPublicationWorks();
    levelUser();
    scoreUser();
  }

  // Recargar foro
  if(operation == "forum"){
    cleanContentForum();
    loadQueriesForumToUser();
  }

  // Recargar reportes
  if(operation == "historyreport"){
    if(typeof loadReportsTable !== 'undefined' && jQuery.isFunction( loadReportsTable )){
      loadReportsTable();
    } 

    if(typeof loadMonthlyReports !== 'undefined' && jQuery.isFunction( loadMonthlyReports )){
      loadMonthlyReports({ op: 'monthlyReports' });
    } 
  }
};

// Conexión cerrada
socket.onclose = function (result) {
  console.log('Desconectado del servidor');
};  

// Error de conexión
socket.onerror = function (result) {
  console.log('Error al intentar conectar con el servidor');
};


// Validar si exite o esta definida la función
function functionIsDefined(nameFunction){
  let isDefined = typeof nameFunction !== 'undefined' && jQuery.isFunction( nameFunction );
  return isDefined;
  /* if(isDefined){
    nameFunction();
  } */
}

// Recargar especialidades, Validar si exite o esta definida la función
function loadEspecialties(){
  if(typeof listInfo !== 'undefined' && jQuery.isFunction( listInfo )){
    listInfo();
  } 

  if(typeof listEspeciality !== 'undefined' && jQuery.isFunction( listEspeciality )){
    listEspeciality();
  } 
  
  if(typeof totalSpecialtiesAvailable !== 'undefined' && jQuery.isFunction( totalSpecialtiesAvailable )){
    totalSpecialtiesAvailable();
  } 
  
  if(typeof loadPublicationWorks !== 'undefined' && jQuery.isFunction( loadPublicationWorks )){
    loadPublicationWorks();
  } 
  
  if(typeof loadMonthlyReports !== 'undefined' && jQuery.isFunction( loadMonthlyReports )){
    loadGraphics();
  } 
}

// Recargar graficos
function loadGraphics(){
  loadMonthlyReports({ op: 'monthlyReports' });
  totalUsersByService({ op: 'countUsersByService' });
  totalUsersByLevels({ op: 'userLevels' });
}