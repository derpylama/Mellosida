var deltavling;

window.onload = (e) => {
    deltavlingDropDown = document.getElementById("deltavling");
    sparButtons = document.getElementsByClassName("save");
    VisaDatabasinnehall(deltavlingDropDown.value);

    if(deltavling == undefined){
        deltavling = deltavlingDropDown.value;
    }
    
    deltavlingDropDown.onchange = (e) => {
        deltavling = e.target.value;
        tabortAllaDeltagare();
        VisaDatabasinnehall(deltavling);
    }

for (var button of sparButtons) {
    
    button.onclick = (e) => {
       SparaAllData(deltavling);
    }

 };
};


function VisaDatabasinnehall(dropdownVarde){

    url = "../php/funktioner.php?deltavling="+dropdownVarde;
    deltagarLista = document.getElementById("deltagarLista")
        fetch(url).then(answer => answer.json()).then((data) =>{
            
            
            if(data != null){


                startTid = document.getElementById("startTid");
                slutTid = document.getElementById("slutTid");
                datum = document.getElementById("datum");

                data.forEach(data => {

                    startTid.value = data["startTid"];
                    slutTid.value = data["slutTid"];
                    datum.value = data["datum"];
                    
                    div = document.createElement("div");
                    div.className = "deltagare"
                    deltagarLista.appendChild(div);

                    img = document.createElement("img");
                    img.src = data["bildURL"];
                    img.className = "deltagarBild";

                    pBeskrivning = document.createElement("p");
                    pBeskrivning.innerHTML = data["beskrivning"];

                    artistNamn = document.createElement("h2");
                    artistNamn.innerHTML = data["artistNamn"];

                    video = document.createElement("iframe");
                    video.width = 150;
                    video.height = 100;
                    video.src = data["url"];

                    deleteknapp = document.createElement("button");
                    deleteknapp.innerHTML = "delete";
                    deleteknapp.className = "submit";

                    deleteknapp.onclick = (e) => {
                        tabortDelragareDatabas(data["artistNamn"]);
                    }

                    
                    div.appendChild(artistNamn);
                    div.appendChild(pBeskrivning);
                    div.appendChild(img);
                    div.appendChild(video);
                    div.appendChild(deleteknapp);
                })
            }
            else{
               tabortAllaDeltagare();
            }

        });
}

function SparaAllData(deltavling){

    inputelement = document.getElementsByTagName("input");
    inputObj = {};
    inputObj.deltavling = deltavling;
    [...inputelement].forEach(element => {
  
        if(element.type != "button" && element.value != null){
            namn = element.name;
            data = element.value;
            inputObj[namn] = data;
        };
    });
    

    url = "../php/funktioner.php?data=" + JSON.stringify(inputObj);
    fetch(url).then(window.location.reload());
}

function tabortAllaDeltagare(){
    deltagare = document.getElementsByClassName("deltagare");
    startTid = document.getElementById("startTid");
    slutTid = document.getElementById("slutTid");
    datum = document.getElementById("datum");

    startTid.value = "";
    slutTid.value = "";
    datum.value = "";

    [...deltagare].forEach(element =>{
        element.remove();
    })
}

function tabortDelragareDatabas(artist){

    url = "../php/funktioner.php?delete=" + artist;
    fetch(url).then(alert("Tog bort "+ artist)).then(window.location.reload());
}