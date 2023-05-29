document.addEventListener('DOMContentLoaded',()=>{
    const loading2  = document.querySelector(".loading");
})
function showloading(){
    loading2.style.display = 'flex';
    loading2.style.transition = '0.2s'
}
function hideloading(){
    loading2.style.display = 'none';
}

function AutoScroll(){
    window.scrollBy(0,500);
}

//This function returns the brands available
function populateBrand(){
    showloading();
    let select = document.getElementById('filter-select-Brand');
    //1. Create the XMLHttpRequest Object
    let request = new XMLHttpRequest();
    var body = JSON.stringify({
                "studentnum":"u22491032",
                "type":"GetAllMakes",
                "apikey":"a9198b68355f78830054c31a39916b7f",
                "return":["make"]
        })

    //I am using asynchronous because we want the cars to show as soons as the age is loaded.
    //2. create request
    request.open("POST","https://wheatley.cs.up.ac.za/api/",true);
    request.onreadystatechange = function(){
        if(request.readyState== 4 && request.status == 200){
            let Q1=JSON.parse(request.responseText);
            const BrandSet = new Set();
            console.log(Q1);
            Q1.data.forEach(obj => BrandSet.add(obj));
            const uniqueBrand = [...BrandSet];
            console.log(uniqueBrand);
            for(let i=0;i<uniqueBrand.length;i++){
                var opt = uniqueBrand[i];
                var option = document.createElement("option");
                option.textContent = opt;
                option.value = opt;
                select.appendChild(option);
            }
            hideloading();
        }
    }

    //3. Send the request
    request.send(body);
}

function Find_Car(){
    showloading();
    let carlist = document.querySelector('.car-wrapper');
    carlist.innerHTML = '';
    let BrandType = document.getElementById('filter-select-Brand').value.toLowerCase();
    console.log(BrandType);
    let TransType = document.getElementById('filter-select-TT').value.toLowerCase();
    console.log(TransType);
    let Body_Style = document.getElementById('filter-select-car-type').value.toLowerCase();
    console.log(Body_Style);
    if(TransType==""){
        alert("Please select transmission type");
        hideloading();
        return;
    }
    if(Body_Style==""){
        alert("Please select body type");
        hideloading();
        return;
    }
    //1. Create the XMLHttpRequest Object
    let request = new XMLHttpRequest();
    var body = JSON.stringify({
        "studentnum":"u22491032",
        "type":"GetAllCars",
        "apikey":"a9198b68355f78830054c31a39916b7f",
        "limit":50,
        "search":{
            "body_type": Body_Style,
            "transmission":  TransType,
            "make":BrandType
        },
        "sort":"make",
        "order":"DESC",
        "return":[
            "model","make","year_to","transmission","max_speed_km_per_h","transmission","engine_type","drive_wheels",'body_type'
        ]
    });
    //I am using asynchronous because we want the cars to show as soon as the data is loaded.
    //2. create request
    request.open("POST","https://wheatley.cs.up.ac.za/api/",true);
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
                    getPicture(Q1.data[i]['make'],Q1.data[i]['model'],function(image){
                        const html = `<div class="car">
                        <img src="${image}" alt="${Q1.data[i]['model']}">
                        <h2>${Q1.data[i]['model']}</h2>
                        <li>Year: ${Q1.data[i]['year_to']}</li>
                        <li>Brand: ${Q1.data[i]['make']}</li>
                        <li>Transmission: ${Q1.data[i]['transmission']} </li>
                        <li>Top Speed: ${Q1.data[i].max_speed_km_per_h}km/h</li>
                        <li>Fuel Type: ${Q1.data[i]['engine_type']}</li>
                        <li>Drivetrain: ${Q1.data[i]['drive_wheels']}</li>
                        <li>Car Type: ${Q1.data[i]['body_type']}</li>
                    </div>`
                    carlist.insertAdjacentHTML('beforeend',html);
                    });
               } 
            }
        hideloading();    
        }else{
            hideloading();
            let Q1=JSON.parse(request.responseText);
            console.log("Error:"+Q1);
        }
    };
    //3. Send the request
    request.send(body);
    // AutoScroll();
}
function populateTransmission(){
    // let BodyType= document.querySelector("filter-select-car-type");
    var select = document.getElementById('filter-select-TT');
    
    //1. Create the XMLHttpRequest Object
    let request = new XMLHttpRequest();
    var body = JSON.stringify({
                "studentnum":"u22491032",
                "type":"GetAllCars",
                "apikey":"a9198b68355f78830054c31a39916b7f",
                "return":["transmission"]
        })
    
    //2. I am using asynchronous because we want the filter options to be available as soons as the page is loaded. 
    request.open("POST","https://wheatley.cs.up.ac.za/api/",true);
    request.onreadystatechange = function(){
        if(request.readyState== 4 && request.status == 200){
            let Q1=JSON.parse(request.responseText);
            const TransmissionSet = new Set();
            Q1.data.forEach(obj => TransmissionSet.add(obj.transmission));
            const uniqueTrans = [...TransmissionSet];
            console.log(uniqueTrans);
            for(let i=0;i<uniqueTrans.length;i++){
                var opt = uniqueTrans[i];
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
function populateCarType(){
    // let BodyType= document.querySelector("filter-select-car-type");
    var select = document.getElementById('filter-select-car-type');
    
    //1. Create the XMLHttpRequest Object
    let request = new XMLHttpRequest();
    var body = JSON.stringify({
                "studentnum":"u22491032",
                "type":"GetAllCars",
                "apikey":"a9198b68355f78830054c31a39916b7f",
                "return":["body_type"]
        })
    
    //2. I am using asynchronous because we want the filter options to be available as soons as the page is loaded. 
    request.open("POST","https://wheatley.cs.up.ac.za/api/",true);
    request.onreadystatechange = function(){
        if(request.readyState== 4 && request.status == 200){
            let Q1=JSON.parse(request.responseText);
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
document.addEventListener('DOMContentLoaded',()=>{
    const Find_Car_Button = document.getElementById('Find_Car');
    Find_Car_Button.addEventListener('click',Find_Car);
})
hideloading();