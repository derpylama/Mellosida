window.onload = (e) => {
    buttons = document.querySelector(".prevent-select");
    buttons.onclick = (e) => {
        console.log(e.target.tagName);
        Clearpage();
        if(e.target.tagName == "P"){
            fetch("../php/funktioner.php?deltavling="+ e.target.id)
                .then( answer => answer.json()).then( data => {
                    mainInfo = document.getElementById("mainInfo");
                    console.log(data);
                    
                    data.forEach(data => {
                    
                    div = document.createElement("div");
                    div.className = "infoScreen";
                    mainInfo.appendChild(div);

                    img = document.createElement("img");
                    img.src = data["bildURL"];
                    img.className = "deltagarBild";


                    artistNamn = document.createElement("h2");
                    artistNamn.innerHTML = data["artistNamn"];

                    video = document.createElement("iframe");
                    video.className = "video";
                    video.src = data["url"];

                    button = document.createElement("button");
                    button.className = "button";
                    button.innerHTML = "Rösta";
                    

                    div.appendChild(artistNamn);
                    div.appendChild(img);
                    div.appendChild(video);
                    div.appendChild(button);

                    });    
                });
        }

    }
}

function Clearpage(){
    infoScreen = document.getElementsByClassName("infoScreen");

    [...infoScreen].forEach(element =>{
        element.remove();

    })
}