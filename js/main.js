//I am using asynchronous because we want the cars to show as soons as the age is loaded but I have to use 
//the callback function to hanlde the response when it arrives because the image may not load immediately.
window.addEventListener("load" , ()=>{
    const loading = document.querySelector(".loading");
    loading.classList.add("loading-hidden");
    // applyTheme();
    PageLoad();
    if(document.cookie.indexOf('validated')){
        setTimeout(applyFilters,400);
    }
})
const loading  = document.querySelector(".loading");

function showloading(){
    loading.style.display = 'flex';
    loading.style.transition = '0.2s'
}
function hideloading(){
    loading.style.display = 'none';
}
//Const for section where cars are displayed
function getCookieValue(cookieName) {
    const cookies = document.cookie.split('; ');
    for (let i = 0; i < cookies.length; i++) {
      const parts = cookies[i].split('=');
      if (parts[0] === cookieName) {
        return decodeURIComponent(parts[1]);
      }
    }
    return '';
  }

//This function gets all the information about the cars
function PageLoad(){
    showloading();
    const carlist = document.querySelector('.car-wrapper');
    //1. Create the XMLHttpRequest Object
    let request = new XMLHttpRequest();
    var body = JSON.stringify({
                "type":"getWines",
                "return":"*"
        })

    //I am using asynchronous because we want the cars to show as soons as the age is loaded.
    //2. create request
    var url = "../COS221/globals/api.php";
    request.open("POST",url,true);
    request.setRequestHeader("Content-type", "application/json");
    request.onreadystatechange = function(){
        if(request.readyState==4 && request.status == 200){
            console.log(JSON.parse(request.responseText).data[0]);
            let Q1=JSON.parse(request.responseText);
            var cars = Q1.data;
            if(cars.length == 0){
                const html = `<h2>Sorry seems like we don't have what you're looking for in stock<h2>`
                carlist.insertAdjacentHTML('beforeend',html);
            }else{
                for(let i=0; i<Q1.data.length; i++){
                    const html = `<div class="car">
                        <img class="wineimage" src="${Q1.data[i]['Image']}" alt="${Q1.data[i]['Name']}">
                        <h2>${Q1.data[i]['Name']}</h2>
                        <h3>${Q1.data[i]['Grape_Varietal']}</h3>
                        <li>Price: ${Q1.data[i]['Price']}</li>
                        <li>Bottle Size: ${Q1.data[i]['Bottle_Size']} </li>
                        <li>pH: ${Q1.data[i]['pH']}km/h</li>
                        <li>Alcohol Content: ${Q1.data[i]['Alcohol_Content']}</li>
                        <li>Region: ${Q1.data[i]['RegionName']}, ${Q1.data[i]['Country']}</li>
                    </div>`
                    carlist.insertAdjacentHTML('beforeend',html);
               } 
            }
        }else{
            console.log("Error:"+request.responseText.message);
        }
    }
    request.send(body);   
}


const apiKey = getCookieValue('api_key');
console.log(apiKey);

function refine(){
    showloading();
    const carlist = document.querySelector('.car-wrapper');
    let SortStyle = document.getElementById('filter-select-sort').value;
    var order = "DESC";
    

    if(SortStyle == "Price(Highest - Lowest)"){
        var sort = "Price";
        var order = "DESC"
    }else if(SortStyle == "Price(Lowest - Highest)"){
        var sort = "Price";
        var order = "ASC"
    }else if(SortStyle == "Alcohol Content(Highest - Lowest)"){
        var sort = "Alcohol_Content";
        var order = "DESC"
    }else{
        var sort = "Alcohol_Content";
        var order = "ASC"
    }
    
    var body = JSON.stringify({
        "type":"getWines",
        "sort":sort,
        "order":order,
        "return":"*"
    });
    
    carlist.innerHTML = '';
    //1. Create the XMLHttpRequest Object
    let request = new XMLHttpRequest();
    
    console.log(body);
    //I am using asynchronous because we want the cars to show as soon as the data is loaded.
    //2. create request
    request.open("POST","../COS221/globals/api.php",true);
    request.onreadystatechange = function(){
        if(request.readyState== 4 && request.status == 200){
            let Q1=JSON.parse(request.responseText);
            console.log(Q1);
            var cars = Q1.data;
            if(cars.length == 0){
                const html = `<h2>Sorry seems like we don't have what you're looking for in stock<h2>`
                carlist.insertAdjacentHTML('beforeend',html);
            }else{
                for(let i=0; i<Q1.data.length; i++){
                    const html = `<div class="car">
                    <img class="wineimage" src="${Q1.data[i]['Image']}" alt="${Q1.data[i]['Name']}">
                    <h2>${Q1.data[i]['Name']}</h2>
                    <h3>${Q1.data[i]['Grape_Varietal']}</h3>
                    <li>Price: ${Q1.data[i]['Price']}</li>
                    <li>Bottle Size: ${Q1.data[i]['Bottle_Size']} </li>
                    <li>pH: ${Q1.data[i]['pH']}km/h</li>
                    <li>Alcohol Content: ${Q1.data[i]['Alcohol_Content']}</li>
                    <li>Region: ${Q1.data[i]['RegionName']}, ${Q1.data[i]['Country']}</li>
                </div>`
                carlist.insertAdjacentHTML('beforeend',html); 
               } 
            }
        hideloading();    
        }else{
            hideloading();
        }
    };
    //3. Send the request
    request.send(body);
}


function applyFilters(){
    var url = "https://wheatley.cs.up.ac.za/u22491032/COS216/PA4/globals/Settings.php";
    // 1. Create the XMLHttpRequest Object
    let request = new XMLHttpRequest();
    // 2. Define the preferences to send
    var body = JSON.stringify({
        "type":"GetUserPreference",
        "api_key": apiKey
      });
    // 3. Create the request
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/json");
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        let Q1 = JSON.parse(request.responseText);
        if(Q1.data.length != 0){
            console.log(Q1);
            document.getElementById("filter-select-car-type").value = Q1.data[0].Body_type;
            document.getElementById("filter-select-TT").value = Q1.data[0].Transmission_Type;
            document.getElementById("filter-select-sort").value = Q1.data[0].Sort;
            setTimeout(refine,200);
        }
        
      }
    };
    request.send(body);
    
}
//This works
function checkFilters() {
    var carType = document.getElementById("filter-select-car-type");
    var transType = document.getElementById("filter-select-TT");
    var sortStyle = document.getElementById("filter-select-sort");
  
    if (carType.value || transType.value || sortStyle.value) {
        saveFilters();
        // console.log("All options are selected");
    } else {
        alert("Please select all options.");
    }
}
//This Works
function saveFilters(){
    var url = "https://wheatley.cs.up.ac.za/u22491032/COS216/PA4/globals/Settings.php";
    // 1. Create the XMLHttpRequest Object
    let request = new XMLHttpRequest();
    let Body_Type = document.getElementById('filter-select-car-type').value;
    let Trans_Type = document.getElementById('filter-select-TT').value;
    let Sort_Style = document.getElementById('filter-select-sort').value;

    // 2. Define the preferences to send
    var preferences = [Body_Type,Trans_Type,Sort_Style];
    var body = JSON.stringify({
      "type":"PostUserPreference",  
      "api_key": apiKey,
      "preferences": preferences
    });
    console.log(body);
    // 3. Create the request
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/json");
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        let Q1 = JSON.parse(request.responseText);
        console.log(Q1);
        alert("Preferences Saved");
      }else{
            console.log("Error:"+request.responseText.message);
      }
    };
    request.send(body);
}
function applyTheme(themename){
    let LogoImg = document.getElementById('Logo');
    let landingImg = document.getElementById('landing-image');
    if (themename === 'light') {
        LogoImg.src = "img/CARPARADISE.jpg";
        if(landingImg){
            landingImg.src = "img/Models/R8.png";
        }
    }
} 
function toggleActive() {
    const links = document.querySelectorAll('.nav-link'); // get all the nav links
    links.forEach(link => link.classList.remove('active')); // remove active class from all links
  
    this.classList.add('active'); // add active class to the clicked link
  }
  
  const links = document.querySelectorAll('.nav-link'); // get all the nav links
  links.forEach(link => link.addEventListener('click', toggleActive)); // add event listener to each link 
