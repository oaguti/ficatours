const writeTitle = (active)=>{
    const title = document.getElementById('titleDestination')
    const retrievedJsonString = sessionStorage.getItem('destinos');
    const retrievedJsonData = JSON.parse(retrievedJsonString);
    if(title){
        const result = retrievedJsonData.filter((e)=> e.id == active)
        title.innerHTML = result[0].destino
    }
}
const editMenu = (active)=>{
    const menus = document.querySelectorAll('#menu > li > ul > li > a');
    menus.forEach((element)=>{
        const url = `${element.href}?destino=${active}`
        element.setAttribute('href',url)
    })
}

if(typeof activoDestination != 'undefined'){
    idDestination = activoDestination
} else {
    idDestination = sessionStorage.getItem('active');
}

writeTitle(idDestination)
//editMenu(idDestination)