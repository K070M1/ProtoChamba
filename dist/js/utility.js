// Inabilitar saltos de linea (CONTENTEDITABLE) y permitir el maximo de caracteres indicado en su atributo (MAXLENGTH)
function disableLineBreaks(element, event){
  let maxlength = element.attr('maxlength');
 
  // Bloquear salto de linea
  if(event.keyCode == 13){
    event.preventDefault();
  }

  // Maximo de caracteres pemitido
  if (element.html().length == maxlength || element.val().length == maxlength) {
    return false;
  } else {
    return true;
  }
}

// Encontrar coincidencia de objeto
function getIndexArrayObject(arrayObject, item){
  let index = arrayObject.findIndex((element) => {
    return element.name === item;
  });

  // Devolver el indice obtenido (-1 si no se encuentra)
  return index;
}

// Eliminar elemento del array object
function removeItemFromArrayObject(arrayObject, item){
  // Buscar dentro del arr
  let index = arrayObject.findIndex((element) => {
    return element.name === item;
  });

  // Eliminar si existe el elemento buscado
  index !== -1 && arrayObject.splice( index, 1 );   
}

// Eliminar un elemento del array
function removeItemFromArray (arr, item ) {
  let index = arr.indexOf( item );           // obtener el Indice    
  index !== -1 && arr.splice(index, 1 );     // Eliminar si existe
}

// Eliminar los elementos de un contenedor
function clearContainer(element) {
  let div = document.querySelector(element);
  while(div.firstChild) {
    div.removeChild(div.firstChild);
  }
}

// función Find demo 
function findFunctionDemo(arrObject){
  arrObject.find((element, index, array) => {
    console.log(index)
    console.log(element)
    console.log(array)
  });
}