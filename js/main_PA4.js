//I am using asynchronous because we want the cars to show as soons as the age is loaded but I have to use 
//the callback function to hanlde the response when it arrives because the image may not load immediately.
window.addEventListener("load" , ()=>{
    const loading = document.querySelector(".loading");
    loading.classList.add("loading-hidden");
    applyTheme();
    PageLoad();
    populateCar_Type();
    populateTrans_Type();
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
                "studentnum":"u22491032",
                "type":"GetAllCars",
                "limit":9,
                "apikey":"a9198b68355f78830054c31a39916b7f",
                "return":["model","make","year_to","transmission","max_speed_km_per_h","transmission","engine_type","drive_wheels","body_type","id_trim"]
        })

    //I am using asynchronous because we want the cars to show as soons as the age is loaded.
    //2. create request
    var url = "https://wheatley.cs.up.ac.za/u22491032/COS216/PA4/globals/api.php";
    request.open("POST",url,true);
    request.setRequestHeader("Content-type", "application/json");
    request.onreadystatechange = function(){
        if(request.readyState==4 && request.status == 200){
            let Q1=JSON.parse(request.responseText);
            var cars = Q1.data;
            if(cars.length == 0){
                const html = `<h2>Sorry seems like we don't have what you're looking for in stock<h2>`
                carlist.insertAdjacentHTML('beforeend',html);
            }else{
                for(let i=0; i<Q1.data.length; i++){
                    const html = `<div class="car">
                        <img src="${Q1.data[i]['image']}" alt="${Q1.data[i]['model']}">
                        <h2>${Q1.data[i]['model']}</h2>
                        <li>Year: ${Q1.data[i]['year_to']}</li>
                        <li>Brand: ${Q1.data[i]['make']}</li>
                        <li>Transmission: ${Q1.data[i]['transmission']} </li>
                        <li>Top Speed: ${Q1.data[i].max_speed_km_per_h}km/h</li>
                        <li>Fuel Type: ${Q1.data[i]['engine_type']}</li>
                        <li>Drivetrain: ${Q1.data[i]['drive_wheels']}</li>
                        <li>Car_Type: ${Q1.data[i]['body_type']}</li>
                        <div class='slideContainer' style="display: ${document.cookie.indexOf('validated') != -1 ? 'block' : 'none'};">
                        <form action='ratings.php' method='POST'>
                            <input type='hidden' id=car_id name='car_id' value='${Q1.data[i]['id_trim']}'>
                            <input type='range' name='rating' min='1' max ='5'>
                            <input type='submit' id= 'submit'>
                        </form>
                        </div>
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

//This function populates the Car Type
function populateCar_Type(){
    
    //1. Create the XMLHttpRequest Object
    let request = new XMLHttpRequest();
    var body = JSON.stringify({
                "studentnum":"u22491032",
                "type":"GetAllCarTypes",
                "apikey":"a9198b68355f78830054c31a39916b7f",
                "return":["body_type"]
        })

    //I am using asynchronous because we want the cars to show as soons as the age is loaded.
    //2. create request
    var url = "https://wheatley.cs.up.ac.za/u22491032/COS216/PA4/globals/api.php";
    request.open("POST",url,true);
    request.setRequestHeader("Content-type", "application/json");
    request.onreadystatechange = function(){
        if(request.readyState==4 && request.status == 200){
            let Q1=JSON.parse(request.responseText);
            var select = document.getElementById("filter-select-car-type");
            const CarTypeSet = new Set();
            Q1.data.forEach(obj => CarTypeSet.add(obj.body_type));
            const uniqueBody_Types = [...CarTypeSet];
            console.log(uniqueBody_Types);
            for(let i=0;i<uniqueBody_Types.length;i++){
                var opt = uniqueBody_Types[i];
                var option = document.createElement("option");
                option.textContent = opt;
                option.value = opt;
                select.appendChild(option);
            }
        }else{
            console.log("Error:"+request.responseText.message);
        }
    }
    request.send(body);   
}
function populateTrans_Type() {
    // 1. Create the XMLHttpRequest Object
    let request = new XMLHttpRequest();
    var body = JSON.stringify({
      "studentnum": "u22491032",
      "type": "GetAllCarTypes",
      "apikey": "a9198b68355f78830054c31a39916b7f",
      "return": ["Transmission"]
    });
  
    // 2. Create the request
    var url = "https://wheatley.cs.up.ac.za/u22491032/COS216/PA4/globals/api.php";
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/json");
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        let Q1 = JSON.parse(request.responseText);
        var select = document.getElementById("filter-select-TT");
        const transmissionSet = new Set();
        Q1.data.forEach(obj => transmissionSet.add(obj.Transmission));
        const uniqueTransmissions = [...transmissionSet];
        console.log(uniqueTransmissions);
        for (let i = 0; i < uniqueTransmissions.length; i++) {
          var opt = uniqueTransmissions[i];
          var option = document.createElement("option");
          option.textContent = opt;
          option.value = opt;
          select.appendChild(option);
        }
      }
    };
    request.send(body);
  }
  
const apiKey = getCookieValue('api_key');
console.log(apiKey);

function refine(){
    showloading();
    const carlist = document.querySelector('.car-wrapper');
    let CarType = document.getElementById('filter-select-car-type').value;
    let TransType = document.getElementById('filter-select-TT').value;
    let SortStyle = document.getElementById('filter-select-sort').value;
    var order = "DESC";
    

    if(SortStyle == "Model"){
        var sort = "model";
        var order = "ASC"
    }else if(SortStyle == "Brand"){
        var sort = "make";
        var order = "ASC"
    }else if(SortStyle == "body_type"){
        var sort = "body_type";
        var order = "ASC"
    }else{
        var sort="max_speed_km_per_h";
    }
    if(CarType == "" && TransType == ""){
        var body = JSON.stringify({
            "studentnum":"u22491032",
            "type":"GetAllCars",
            "apikey":"a9198b68355f78830054c31a39916b7f",
            "sort":sort,
            "order":order,
            "limit":25,
            "return":[
                "model","make","year_to","transmission","max_speed_km_per_h","engine_type","drive_wheels",'body_type',"id_trim"
            ]
        });
    }else if(CarType==""){
        var body = JSON.stringify({
            "studentnum":"u22491032",
            "type":"GetAllCars",
            "apikey":"a9198b68355f78830054c31a39916b7f",
            "search":{
                "transmission": TransType.toLowerCase()
            },
            "sort":sort,
            "order":order,
            "limit":25,
            "return":[
                "model","make","year_to","transmission","max_speed_km_per_h","engine_type","drive_wheels",'body_type',"id_trim"
            ]
        });
    }else if(TransType==""){
        var body = JSON.stringify({
            "studentnum":"u22491032",
            "type":"GetAllCars",
            "apikey":"a9198b68355f78830054c31a39916b7f",
            "search":{
                "body_type": CarType.toLowerCase()
            },
            "sort":sort,
            "order":order,
            "limit":25,
            "return":[
                "model","make","year_to","transmission","max_speed_km_per_h","engine_type","drive_wheels",'body_type',"id_trim"
            ]
        });
    }else{
        var body = JSON.stringify({
            "studentnum":"u22491032",
            "type":"GetAllCars",
            "apikey":"a9198b68355f78830054c31a39916b7f",
            "search":{
                "body_type": CarType.toLowerCase(),
                "transmission":  TransType.toLowerCase()
            },
            "sort":sort,
            "order":order,
            "limit":25,
            "return":[
                "model","make","year_to","transmission","max_speed_km_per_h","engine_type","drive_wheels",'body_type',"id_trim"
            ]
        });
    }
    carlist.innerHTML = '';
    //1. Create the XMLHttpRequest Object
    let request = new XMLHttpRequest();
    
    console.log(body);
    //I am using asynchronous because we want the cars to show as soon as the data is loaded.
    //2. create request
    request.open("POST","https://wheatley.cs.up.ac.za/u22491032/COS216/PA4/globals/api.php",true);
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
                    <img src="${Q1.data[i]['image']}" alt="${Q1.data[i]['model']}">
                    <h2>${Q1.data[i]['model']}</h2>
                    <li>Year: ${Q1.data[i]['year_to']}</li>
                    <li>Brand: ${Q1.data[i]['make']}</li>
                    <li>Transmission: ${Q1.data[i]['transmission']} </li>
                    <li>Top Speed: ${Q1.data[i].max_speed_km_per_h}km/h</li>
                    <li>Fuel Type: ${Q1.data[i]['engine_type']}</li>
                    <li>Drivetrain: ${Q1.data[i]['drive_wheels']}</li>
                    <li>Car_Type: ${Q1.data[i]['body_type']}</li>
                    <div class='slideContainer' style="display: ${document.cookie.indexOf('validated') != -1 ? 'block' : 'none'};">
                        <form action='ratings.php' method='POST'>
                            <input type='hidden' id=car_id name='car_id' value='${Q1.data[i]['id_trim']}'>
                            <input type='range' name='rating' min='1' max ='5'>
                            <input type='submit' id= 'submit'>
                        </form>
                    </div>
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










