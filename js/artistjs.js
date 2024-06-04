var competition;
var active = false;

window.onload = (e) => {
    buttons = document.querySelector("nav");
    
    buttons.onclick = (e) => {
        if(e.target.tagName == "P"){
            competition = e.target.id;
            sessionStorage.setItem("competition", e.target.id);
            showParticipants(e)
        }
    }

    if(sessionStorage.getItem("competition") != null){
        competition = sessionStorage.getItem("competition");
        showParticipants();
    }

    isActive();
    localStorage.setItem(competition, 0);
}


//Skriver ut varje deltagare i deltävlingen
function showParticipants(){
        clearPage();

        fetch("php/funktioner.php?deltavling="+ competition)
            .then( answer => answer.json()).then( (data) => {
                mainInfo = document.getElementById("mainInfo");
                

                data.forEach(data => {
                
                div = document.createElement("div");
                div.className = "infoScreen";
                mainInfo.appendChild(div);

                img = document.createElement("img");
                img.src = data["bildURL"];
                img.className = "deltagarBild";


                artistName = document.createElement("h2");
                artistName.innerHTML = data["artistNamn"];

                video = document.createElement("iframe");
                video.className = "video";
                video.src = data["url"];

                button = document.createElement("button");
                button.id = data["artistNamn"];
                button.innerHTML = "Rösta";
                

                div.appendChild(artistName);
                div.appendChild(img);
                div.appendChild(video);
                div.appendChild(button);

                });  
                voteButtons = document.getElementsByTagName("button");
                
                [...voteButtons].forEach(element => {
                    element.onclick = (e) => {
                        vote(e);
                    }
                })
            });
}
function clearPage(){
    infoScreen = document.getElementsByClassName("infoScreen");

    [...infoScreen].forEach(element =>{
        element.remove();

    })
}

//Kollar om deltävlingen som du försöker rösta på är live nu
function isActive() {
    fetch("php/funktioner.php?deltavling="+ competition)
    .then( answer => answer.json()).then( (data) => {
        date = new Date();
    
        currentTime = date.getTime();

        startTime = data[0]["startTid"] + " " + data[0]["datum"];
        startTime = new Date(startTime).getTime();
        
        stopTime = data[0]["slutTid"] + " " + data[0]["datum"]
        stopTime = new Date(stopTime).getTime();
        
        if(currentTime >= startTime && currentTime <= stopTime){
            active = true;
        }
        else{
            active = false;
        }
    })
}

//Ökar rösterna hos den artist som klickats på
function vote(e){
    artist = e.target.id;
    isActive()
    
    if(active === true){
        
        if(localStorage.getItem(competition) < 5){
            fetch("php/funktioner.php?artist=" + artist)

            amountOfVotes = localStorage.getItem(competition);
            amountOfVotes = parseInt(amountOfVotes);
            amountOfVotes += 1;
            localStorage.setItem(competition, amountOfVotes);

        }
        else{
            alert("Du har slut på röster")
        }
    }
    else{
        alert("Deltävling är inte activ")
    }

}