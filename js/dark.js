var icon = document.getElementById("icon");
icon.onclick = function() {
    document.body.classList.toggle("dark-theme");
    if(document.body.classList.contains("dark-theme")) {
        icon.src="https://iili.io/JXnDUyQ.png";
    }else{
        icon.src="https://iili.io/JXnDsMF.png";
    }
}
