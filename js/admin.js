window.onload = (e) => {
    deltavlingDropDown = document.getElementById("deltavling").value;
    console.log(deltavlingDropDown);

    deltavlingDropDown.onchange = (e) => {
        VisaDatabasinnehall(deltavlingDropDown);
        
    }
};

function VisaDatabasinnehall(dropdownVarde){
    url = "../php/funktioner.php?deltavling=" + dropdownVarde;
    deltagarLista = document.getElementById("deltagarLista")
        fetch(url).then(answer => answer.json()).then((data) =>{
            console.log(data);
            
            
            div = document.createElement("div");
            div.className = "deltagare"
            deltagarLista.appendChild(div);

            img = document.createElement("img");
            img.src = data["bildURL"];

            div.appendChild(img);

            pBeskrivning = document.createElement("p");
            pBeskrivning.innerHTML = data["beskrivning"];
            div.appendChild(pBeskrivning);


            /*
            try{
                dataKeys = Object.keys(data);
                console.log("save");
                dataKeys.forEach(element => {
                    document.getElementById("deltagarLista").innerHTML += data[element];
                });
            }
            catch{
                console.log("test");
            }
            */
        });
}