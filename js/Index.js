window.onload = (e) => {
    buttons = document.querySelector("nav");
    //Byter sida till artist sida och skickar med deltvävling
    buttons.onclick = (e) => {
        if(e.target.tagName == "P"){
            sessionStorage.setItem("competition", e.target.id);
            window.location.href = "artist.html"
        }
    }

    fetch("php/funktioner.php?tid=true").then(answer => answer.json()).then(data => {
        infoScreen = document.getElementById("infoScreen");

        data.forEach(deltavling => {
            div = document.createElement("div");
            infoScreen.appendChild(div);

            p = document.createElement("p");
            p.innerHTML = deltavling["deltavlingsNamn"];
            div.appendChild(p);

            pTime = document.createElement("p");
            pTime.innerHTML = deltavling["startTid"] + "-" + deltavling["slutTid"];
            div.appendChild(pTime);

            pDate = document.createElement("p");
            pDate.innerHTML = deltavling["datum"];
            div.appendChild(pDate);
        });
    })
}