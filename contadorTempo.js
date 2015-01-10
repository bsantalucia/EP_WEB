count = 51;
var myVar = setInterval(function(){time()}, 1000); //a cada 1 segundo chama a função

function time(){
	count--;
	if(count < 0){
		alert("Tempo Esgotado!");
			window.location.assign("../index.html")
		}
		else
			document.getElementById("contador").innerHTML = count;
}
