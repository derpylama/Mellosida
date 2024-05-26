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
            console.log(data);
            
            
            if(data != null){

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
                
                div.appendChild(artistNamn);
                div.appendChild(pBeskrivning);
                div.appendChild(img);
            }
            else{
                deltagare = document.getElementsByClassName("deltagare");

                deltagare[0].remove();

               
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
    console.log(inputObj);

    url = "../php/funktioner.php?data=" + JSON.stringify(inputObj);
    fetch(url).then(answer => answer.json()).then(console.log(data));
}