function oi(){
    alert("oi");
}
        function mostrarSugestao(str) {
            if (str.length == 0) {
                document.getElementById("txtSugestao").innerHTML = "";
                return;
            }
           
            const xmlhttp = new XMLHttpRequest();
           
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   
                    document.getElementById("txtSugestao").innerHTML = this.responseText;
                }
            };
           
            xmlhttp.open("GET", "http://localhost/estruturamvc/OperadorCaixa/troco?q=" + str, true);
            xmlhttp.send();
        }
  