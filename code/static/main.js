import { dodaj_v_bazo, posodobi_bazo, izbrisi_iz_baze, getContacts } from "http://localhost/velika-naloga3/static/baza.js";

function poisci (event) {
    const vnos = document.getElementById("poisci-input").value;

    const seznam = document.getElementById("kontakti");
    const vnosi = seznam.getElementsByTagName("li");

    for(let i = 0; i < vnosi.length; i++) {
        if ((vnosi[i].childNodes[0].innerHTML.toUpperCase().indexOf(vnos.toUpperCase()) == -1)){
            vnosi[i].style.display = "none";
        } else {
            vnosi[i].style.display = "";
        }
    }
    if (document.getElementById("reset") == null && vnos.length > 0) {
        const reset = document.createElement("input");
        reset.value = "Prekliči iskanje";
        reset.type = "button";
        reset.id = "reset"
        reset.onclick = vsi_elementi;
        document.querySelector("#poisci > form").appendChild(reset);
    }
}
function vsi_elementi(event) {
    const seznam = document.getElementById("kontakti");
    const vnosi = seznam.getElementsByTagName("li");
    document.querySelector("#poisci > form").removeChild(document.getElementById("reset"));

    for(let i = 0; i<vnosi.length; i++) {
        vnosi[i].style.display = "";
    }
}

function razvrsti(event) {
    const seznam = document.getElementById("kontakti");
    const vnosi = seznam.getElementsByTagName("li");
    let indeksirani_vnosi = [];
    for(let i = 0; i < vnosi.length; i++) {
        if (event.target.id == "po-imenih") {
            indeksirani_vnosi[i] = [vnosi[i].childNodes[0].childNodes[0].innerHTML, vnosi[i]];
        }
        else if (event.target.id == "po-priimkih") {
            indeksirani_vnosi[i] = [vnosi[i].childNodes[0].childNodes[2].innerHTML, vnosi[i]];
        }
        else if (event.target.id == "po-starosti") {
            indeksirani_vnosi[i] = [vnosi[i].childNodes[2].childNodes[2].innerHTML, vnosi[i]];
        }
    }
    const list = document.getElementById("list");
    list.innerHTML = "";

    indeksirani_vnosi.sort((a, b) => { return a[0].localeCompare(b[0], undefined, { numeric: true }) } )

    for(let i = 0; i < indeksirani_vnosi.length; i++) {
        list.appendChild(indeksirani_vnosi[i][1]);
    }
    razvrsti_menu();
}

function razvrsti_menu(event) {
    document.getElementById("razvrsti-izbira").style.display = "";
    if (document.getElementById("razvrsti-izbira").classList == "ni-razvrsti"){
        document.getElementById("razvrsti-izbira").classList = "je-razvrsti";
    } else{
        document.getElementById("razvrsti-izbira").classList = "ni-razvrsti";
    }
}

function uredi(event) {
    const list = document.getElementById("list");
    odpri_uredi(event);
    
    // Preberemo vnose
    const ime = document.getElementById("ime-uredi");
    const priimek = document.getElementById("priimek-uredi");
    const telst = document.getElementById("telst-uredi");
    const email = document.getElementById("email-uredi");
    const starost = document.getElementById("starost-uredi");

    // Vrednosti v tabeli
    const get_ime = event.target.parentElement.childNodes[0].childNodes[0].innerHTML;
    const get_priimek = event.target.parentElement.childNodes[0].childNodes[2].innerHTML;
    const get_telst = event.target.parentElement.childNodes[2].childNodes[0].innerHTML;
    const get_email = event.target.parentElement.childNodes[2].childNodes[1].innerHTML;
    const get_starost = event.target.parentElement.childNodes[2].childNodes[2].innerHTML;
    const get_id = event.target.parentElement.childNodes[2].childNodes[3].innerHTML;

    ime.value = get_ime;
    priimek.value = get_priimek;
    telst.value = get_telst;
    email.value = get_email;
    starost.value = get_starost;
    
    document.getElementById("potrdi-uredi").onclick = ( () => {
        if (!/[a-zA-Z]+/.test(ime.value) || ime.value.length == 0)
            alert("Ime ni pravilno! Dovoljene samo crke od a do z. OBVEZNO !");
        else if(!/[a-zA-Z]+/.test(priimek.value) || priimek.value.length == 0)
            alert("Priimek ni pravilen! Dovoljene samo crke od a do z. OBVEZNO !");
        else if(!/[0-9]{9}/.test(telst.value) && telst.value.length != 0)
            alert("Telefonska stevilka ni pravilna! Lahko so samo stevilke, obvezno 9 stevk.");
        else if(!/[a-zA-Z]+[@][a-zA-Z]+[.][a-zA-Z]+/.test(email.value) && email.value.length != 0)
            alert("eMail ni pravilen!");
        else if(!/[[0-9]+/.test(starost.value) && starost.value.length != 0)
            alert("Starost ni pravilna! Dovoljena so le pozitivna stevila.");
        else {
            event.target.parentElement.childNodes[0].childNodes[0].innerHTML = ime.value;
            event.target.parentElement.childNodes[0].childNodes[2].innerHTML = priimek.value;
            event.target.parentElement.childNodes[2].childNodes[0].innerHTML = telst.value;
            event.target.parentElement.childNodes[2].childNodes[1].innerHTML = email.value;
            event.target.parentElement.childNodes[2].childNodes[2].innerHTML = starost.value;
            posodobi_bazo(get_id, ime.value, priimek.value, telst.value, email.value, starost.value);
            odpri_uredi(event);
        }
    });
    document.getElementById("izbrisi").onclick = ( () => {
        list.removeChild(event.target.parentElement);
        izbrisi_iz_baze(get_id)
        odpri_uredi(event);
    });
}



function prikazi(event) {
    document.getElementById("prikazi-kontakt").style.display = "";
    let t;

    if (event.target.parentElement.parentNode.id == "list") 
        t = event.target.parentElement;
    else
        t = event.target.parentElement.parentElement;

    document.getElementById("prikazi-ime").innerHTML = "Ime: " + t.childNodes[0].childNodes[0].innerHTML;
    document.getElementById("prikazi-priimek").innerHTML = "Priimek: " + t.childNodes[0].childNodes[2].innerHTML;
    document.getElementById("prikazi-telst").innerHTML = "Telefonska številka: " + t.childNodes[2].childNodes[0].innerHTML;
    document.getElementById("prikazi-email").innerHTML = "eMail: " + t.childNodes[2].childNodes[1].innerHTML;
    document.getElementById("prikazi-starost").innerHTML = "Starost: " + t.childNodes[2].childNodes[2].innerHTML;
}

function dodaj_v_tabelo(nova_oseba) {

    // Dodamo ime in priimek
    const list = document.getElementById("list");
    const vrsta = document.createElement("li");
    const button = document.createElement("button");
    if (nova_oseba["setting"] == 1 || nova_oseba["setting"] == 3) {
        button.onclick = uredi;
        button.innerHTML = "Uredi"
    }
    const span = document.createElement("span");
    span.onclick = prikazi;
    span.style.cursor = "pointer";

    const ime = document.createElement("span");
    ime.innerHTML = nova_oseba["ime"];

    const priimek = document.createElement("span");
    priimek.innerHTML = nova_oseba["priimek"];

    const space = document.createElement("span");
    space.innerHTML = "&nbsp;";


    span.appendChild(ime);
    span.appendChild(space);
    span.appendChild(priimek);

    // Dodamo ostale podatke, ki so nevidni
    const telst = document.createElement("span");
    const email = document.createElement("span");
    const starost = document.createElement("span");
    const id = document.createElement("span");
    const setting = document.createElement("span");

    telst.innerHTML = nova_oseba["telst"];
    telst.className = "telst";

    email.innerHTML = nova_oseba["email"];
    email.className = "email";

    starost.innerHTML = nova_oseba["starost"];
    starost.className = "starost";

    id.innerHTML = nova_oseba["id_num"];
    id.className = "id";

    setting.innerHTML = nova_oseba["setting"];
    setting.className = "setting";

    const skrito = document.createElement("span");
    skrito.className = "skrito";
    skrito.style = "display: none;"
    skrito.appendChild(telst);
    skrito.appendChild(email);
    skrito.appendChild(starost);
    skrito.appendChild(id);
    skrito.appendChild(setting);

    vrsta.appendChild(span);
    vrsta.appendChild(button);
    vrsta.appendChild(skrito);
    list.appendChild(vrsta);
}

function dodaj(event) {
    // Preberemo vnose
    const ime = document.getElementById("ime").value;
    const priimek = document.getElementById("priimek").value;
    const telst = document.getElementById("telst").value;
    const email = document.getElementById("email").value;
    const starost = document.getElementById("starost").value;

    const settings = document.getElementsByName('setting');
    let setting;  
    for(let i = 0; i < settings.length; i++) {
        if(settings[i].checked)
            setting = settings[i].value;
    }


    if (!/[a-zA-Z]+/.test(ime) || ime.length == 0)
        alert("Ime ni pravilno! Dovoljene samo crke od a do z. OBVEZNO !");
    else if(!/[a-zA-Z]+/.test(priimek) || priimek.length == 0)
        alert("Priimek ni pravilen! Dovoljene samo crke od a do z. OBVEZNO !");
    else if(!/[0-9]{9}/.test(telst) && telst.length != 0)
        alert("Telefonska stevilka ni pravilna! Lahko so samo stevilke, obvezno 9 stevk.");
    else if(!/[a-zA-Z]+[@][a-zA-Z]+[.][a-zA-Z]+/.test(email) && email.length != 0)
        alert("eMail ni pravilen!");
    else if(!/[[0-9]+/.test(starost) && starost.length != 0)
        alert("Starost ni pravilna! Dovoljena so le pozitivna stevila.");
    else {
        // Izpraznimo polja
        document.getElementById("ime").value = "";
        document.getElementById("priimek").value = "";
        document.getElementById("telst").value = "";
        document.getElementById("email").value = "";
        document.getElementById("starost").value = "";

        // Naredimo nov objekt za osebo
        const nova_oseba = {
            ime: ime,
            priimek: priimek,
            telst: telst,
            email: email,
            starost: starost,
            setting: setting
        };
        let resp = dodaj_v_bazo(nova_oseba["ime"], nova_oseba["priimek"], nova_oseba['telst'], nova_oseba['email'], nova_oseba['starost'], nova_oseba['setting']);
        resp.then(function (response) {
            return response.text();
        }).then(function (id_num) {
            const nova_oseba = {
                ime: ime,
                priimek: priimek,
                telst: telst,
                email: email,
                starost: starost,
                setting: setting,
                id_num: id_num
            };
            dodaj_v_tabelo(nova_oseba);
        });
        odpri_vnos();
    }


}

function preklici(event) {
    if (event.target.parentElement.parentElement.id == "vnos") {
        document.getElementById("ime").value = "";
        document.getElementById("priimek").value = "";
        document.getElementById("telst").value = "";
        document.getElementById("email").value = "";
        document.getElementById("starost").value = "";
        odpri_vnos(event);
    } else {
        odpri_uredi(event);
    }
}

function odpri_vnos(event) {
    document.getElementById("vnos").style.display = "";
    if (document.getElementById("vnos").classList == "ni-vnosa"){
        document.getElementById("vnos").classList = "je-vnos";
    } else{
        document.getElementById("vnos").classList = "ni-vnosa";
    }
}

function odpri_uredi(event) {
    document.getElementById("uredi").style.display = "";
    if (document.getElementById("uredi").classList == "ni-vnosa"){
        document.getElementById("uredi").classList = "je-vnos";
    } else{
        document.getElementById("uredi").classList = "ni-vnosa";
    }
}

const data  = await getContacts();
data.forEach(element => {
    const nova_oseba = {
        ime: element.ime,
        priimek: element.priimek,
        telst: element.telst,
        email: element.email,
        starost: element.starost,
        setting: element.setting,
        id_num: element.id
    };
    dodaj_v_tabelo(nova_oseba);
});

let id;
function radio() {
    let opcije = document.querySelectorAll("label[class = 'setting']");
    document.getElementById('set3').checked = true;
    id = opcije[2];
    id.classList.add("selected-setting");
    [].forEach.call(opcije, element => {
        element.addEventListener("click", () => {
            id.classList.remove("selected-setting");
            element.classList.add("selected-setting");
            id = element;
        });
    });
}


if (document.readyState !== "loading") {
    id = document.getElementsByClassName("settings")[2]
    radio();
    if (document.getElementById("plus"))
        document.getElementById("plus").onclick = odpri_vnos;

    document.getElementById("potrdi-input").onclick = dodaj;
    document.getElementById("preklici-input").onclick = preklici;

    document.getElementById("preklici-uredi").onclick = preklici;

    document.getElementById("isci").onclick = poisci;
    
    document.getElementById("razvrsti").onclick = razvrsti_menu;
    document.getElementById("po-imenih").onclick = razvrsti;
    document.getElementById("po-priimkih").onclick = razvrsti;
    document.getElementById("po-starosti").onclick = razvrsti;

    document.getElementById("pospravi").onclick = ( () => {
        document.getElementById("prikazi-kontakt").style.display = "none";
    });
}