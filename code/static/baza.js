export function dodaj_v_bazo (ime='', priimek='', telst='', email='', starost='', setting='3') {
    let body =  "ime="      + ime       + "&" +
                "priimek="  + priimek   + "&" +
                "telst="    + telst     + "&" +
                "email="    + email     + "&" +
                "setting="  + setting   + "&" +
                "starost="  + starost;
    return ajax(window.location.href.split("index.php")[0] + 'index.php/user/contact/add', body.length, body);
}
export function posodobi_bazo (id, ime='', priimek='', telst='', email='', starost='') {
    let body =  "ime="      + ime       + "&" +
                "priimek="  + priimek   + "&" +
                "telst="    + telst     + "&" +
                "email="    + email     + "&" +
                "starost="  + starost   + "&" +
                "id="       + id;

    ajax(window.location.href.split("index.php")[0] + 'index.php/user/contact/update', body.length, body)
}
export function izbrisi_iz_baze(id) {
    let body = "id="+id;
    ajax(window.location.href.split("index.php")[0] + 'index.php/user/contact/remove', body.length, body)

}

function ajax(url, l, body) {
    return fetch(url,
        {   
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Content-Length': l
            },
            method: 'POST',
            body: body
        }

        );

        // .then(function (response) {
        //     return response.text();
        // }).then(function (html) {
        //     return (html);
        // })
}

export async function getContacts() {
    return fetch(window.location.href.split("index.php")[0] + 'index.php/user/contact/list').then(res => res.json());
}
   
  
export async function arrayOfLi() {
    const data  = await getContacts();
    return data;
}