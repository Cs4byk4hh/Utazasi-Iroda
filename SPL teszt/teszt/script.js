function searchCountries() {
    var input1 = document.getElementById("searchInput1").value;
    var input2 = document.getElementById("searchInput2").value;
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("box").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "php.php?input1=" + input1 + "&input2=" + input2, true);
    xhttp.send();
}