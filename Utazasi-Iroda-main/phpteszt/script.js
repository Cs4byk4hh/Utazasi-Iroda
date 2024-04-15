function searchCountries() {
    var input1 = document.getElementById('searchInput1').value;
    var input2 = document.getElementById('searchInput2').value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('box').innerHTML = this.responseText;
        }
    };
    xhr.open('GET', 'php2.php?input1=' + encodeURIComponent(input1) + '&input2=' + encodeURIComponent(input2), true);
    xhr.send();
}