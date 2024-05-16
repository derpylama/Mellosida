window.onload = (e) => {
    deltavlingDropDown = document.getElementById("deltavling");
    VisaDatabasinnehall(deltavlingDropDown.value);

    deltavlingDropDown.onchange = (e) => {
        VisaDatabasinnehall(e.target.value);
    }
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

                div.appendChild(img);

                pBeskrivning = document.createElement("p");
                pBeskrivning.innerHTML = data["beskrivning"];
                div.appendChild(pBeskrivning);
            }
            else{
                deltagare = document.getElementsByClassName("deltagare");

                deltagare[0].remove();

                console.log(deltagare);
            }

        });
}