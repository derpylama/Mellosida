window.onload = (e) => {
    deltavlingDropDown = document.getElementById("deltavling");

    deltavlingDropDown.onchange = (e) => {
        
        fetch("../php/admin.php?deltavling="+e.target.value.text, {method: 'GET'});

    }
};