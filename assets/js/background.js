function changeBackground() {
    document.getElementById("top-background").classList.toggle("transparent");
    sessionStorage.setItem("background", (sessionStorage.getItem("background") === "bottom") ? "top" : "bottom");
}

if(sessionStorage.getItem("background") === "bottom")
    document.getElementById("top-background").classList.toggle("transparent");

setInterval(changeBackground, 10000);