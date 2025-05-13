function getFechaVencimiento(){	
	//Instancia un objeto de la clase Date con una fecha dada.	
	var fecha = new Date(separarTerminos(document.getElementById("fAlquiler").value));
	
	/*Se toman la cantidad de dias que se quiere incrementar la fecha.	
	/Se suman los dias a la fecha dada y se la convierte en cadena para mostrar en pantalla.*/
	document.getElementById("fVto").setAttribute("value",sumarDias(fecha,parseInt(document.getElementById("dias").value)).toString());	
}

/********************FUNCIONES AUXILIARES**********************************************************************/
function separarTerminos(f){
	
	/*Se deben separar los valores de la fecha y se retorna una cadena, con el formato que requiere 
	la clase Date para iniciar con una fecha en particular*/	
	
	valFechas = f.split("/");
	
	/*Ejemplo: ingresa '20/01/2017' retorna '2017,01,20' */
	
	return valFechas[2]+','+valFechas[1]+','+valFechas[0];	
}

function sumarDias(f,d) {
	
	/*Suma a una fecha dada "f" una cantidad de días "d".  	
	 Ejemplo: f: "2017 01 20" d: 30 dias. La funcion cambia el mes y actualiza el valor a "2017 02 19".
	 Enero tiene 31 días, por lo que al sumar 30 días el resultado es el 19 del mes de Febrero.*/
    
	f.setDate(f.getDate()+d);	
	
	/*Retorna la fecha con el formato que se requiera, utilizando la funciones de la clase Date. 
	slice(-2): da formato al numero del dia o el mes: cuando son < 10, agrega un 0 a la izquierda.*/
	
	return ("0"+parseInt(f.getDate())).slice(-2) +'/'+ ("0"+parseInt(f.getMonth()+1)).slice(-2) +'/'+f.getFullYear();	
}



