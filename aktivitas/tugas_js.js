window.onload = function () {
    var userName = prompt("Tuliskan nama kamu:");

    if (userName != null && userName != "") {
        document.getElementById("nama").innerHTML = userName;
    } else {
        document.getElementById("nama").innerHTML = "Tidak ada nama yang diinput";
    }
};