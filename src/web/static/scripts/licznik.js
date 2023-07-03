function count_clicks() {
    if (localStorage.tlo_count) {
        localStorage.tlo_count = Number(localStorage.tlo_count) + 1;
    } else {
        localStorage.tlo_count = 1;
    }
    var div = document.getElementById("licznik");
    div.innerHTML = "Ile razy ogólnie zminiło sie tło: " +
        localStorage.tlo_count;
}

function count_clicks_session() {
    if (sessionStorage.tlo_count) {
        sessionStorage.tlo_count = Number(sessionStorage.tlo_count) + 1;
    } else {
        sessionStorage.tlo_count = 1;
    }
    var div = document.getElementById("licznik-sesja");
    div.innerHTML = "Ile razy zminiłeś tło:  " +
        sessionStorage.tlo_count;
}
