function search(){
    let timerID;
    const searchQuery = document.getElementById("input-box-1").value;
    const carlist = document.getElementById("carlist");
    carlist.innerHTML = ''; // clear the carlist before inserting new items
    clearTimeout(timerID);
    timerID = setTimeout(()=>{
        let request = new XMLHttpRequest();
        var body = JSON.stringify({
            "studentnum":"u22491032",
            "type":"GetAllCars",
            "apikey":"a9198b68355f78830054c31a39916b7f",
            "search":{
                "make":searchQuery 
            },
            "return":[
                "model","make","year_to","transmission","max_speed_km_per_h","engine_type","drive_wheels","body_type","id_trim"
            ]
        });
        console.log(body);
        //I am using asynchronous because we want the cars to show as soon as the age is loaded.
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
        };
        request.send(body);
    }
},500);
    window.location.href = "/Cars.php?search=" + searchQuery;
}