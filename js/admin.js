window.onload = (e) => {
    deltavlingDropDown = document.getElementById("deltavling");
    sparButton = document.getElementsByClassName("save");
    VisaDatabasinnehall(deltavlingDropDown.value);
    
    deltavlingDropDown.onchange = (e) => {
        VisaDatabasinnehall(e.target.value);
    }

    sparButton.forEach(element => {
        element.onclick() = (e) => {

        }
    });
};


function VisaDatabasinnehall(dropdownVarde){
    url = "../php/funktioner.php?deltavling=" + dropdownVarde;
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

                console.log(deltagare);
            }

        });
}

function SparaAllData(deltavling){
    
}