window.addEventListener("load",()=>{
    const loading = document.querySelector(".loading");
    loading.classList.add("loading-hidden");
})

//This function gets all the brand pictures
function getPicture(brand,callback){
    const xHttp = new XMLHttpRequest();
    var url = "https://wheatley.cs.up.ac.za/api/getimage?brand="+brand;
    xHttp.open("GET",url,true);
    xHttp.onreadystatechange = function(){
    if(xHttp.readyState == 4 && xHttp.status == 200){
        var image = xHttp.responseText;
        callback(image);
        }
    };
    xHttp.send();
}

//This function gets all the brand/make information
function BrandsLoad(){
    let carlist = document.querySelector('.brand-wrapper');

    //1. Create the XMLHttpRequest Object
    let request = new XMLHttpRequest();
    var body = JSON.stringify({
                "studentnum":"u22491032",
                "type":"GetAllMakes",
                "apikey":"a9198b68355f78830054c31a39916b7f"
        })

    //I am using asynchronous because we want the cars to show as soons as the age is loaded.
    //2. create request
    request.open("POST","https://wheatley.cs.up.ac.za/api/",true);
    request.onreadystatechange = function(){
        if(request.readyState== 4 && request.status == 200){
            let Q1=JSON.parse(request.responseText);
            console.log(Q1);
           for(let i=0; i<Q1.data.length; i++){
                getPicture(Q1.data[i],function(image){
                    const html = `<div class="brand">
                    <img src="${image}" alt="${Q1.data[i]}">
                    <h3>${Q1.data[i]}</h3>
                  </div>`
                carlist.insertAdjacentHTML('beforeend',html);
                });
           } 
            
        }else{
            console.log("Error");
        }
    }

    //3. Send the request
    request.send(body);
}
