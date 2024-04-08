function from_country_search() {
    let input = document.getElementById('from_searchbar').value
    input = input.toLowerCase();
    let x = document.getElementsByClassName('from_countries');
   
    for (i = 0; i < x.length; i++) {
      if (!x[i].innerHTML.toLowerCase().includes(input)) {
        x[i].style.display = "none";
      }
      else {
        x[i].style.display = "list-item";
      }
    }
};

function to_country_search() {
    let input = document.getElementById('to_searchbar').value
    input = input.toLowerCase();
    let x = document.getElementsByClassName('to_countries');
   
    for (i = 0; i < x.length; i++) {
      if (!x[i].innerHTML.toLowerCase().includes(input)) {
        x[i].style.display = "none";
      }
      else {
        x[i].style.display = "list-item";
      }
    }
};