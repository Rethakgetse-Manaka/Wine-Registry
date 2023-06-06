var wineryid = document.getElementById("wineryID");
wineryid.addEventListener("keyup", winderyIDValidation);

var productSize = document.getElementById("productionSize");
productSize.addEventListener("keyup", productSizeValidation);

var winemaker = document.getElementById("winemaker");
winemaker.addEventListener("keyup", winemakerNameValidate);

var vineyard = document.getElementById("vineyard");
vineyard.addEventListener("keyup", vineyardValidate);

var image = document.getElementById("image");


function winderyIDValidation(){
    const numReg = /^(WW)?[0-9]+$/;
    if(wineryid.value === ""){
        document.getElementById("demo1").style.color = "red"; 
        document.getElementById("demo1").innerHTML = "Winery ID must be filled in!";       
        return false;
    }
    if(wineryid.value.match(numReg))
    {
        document.getElementById("demo1").style.color = "green"; 
        document.getElementById("demo1").innerHTML = "Valid winery ID input.";
        return true;
    }else
    {
        document.getElementById("demo1").style.color = "red"; 
        document.getElementById("demo1").innerHTML = "Winery ID must be a number!";       
        return false;
    }
}

function productSizeValidation(){
    const numReg = /^[0-9]+$/;
    if(productSize.value === ""){
        return true;
    }
    if(productSize.value.match(numReg))
    {
        document.getElementById("demo2").style.color = "green"; 
        document.getElementById("demo2").innerHTML = "Valid product size input.";
        return true;
    }else
    {
        document.getElementById("demo2").style.color = "red"; 
        document.getElementById("demo2").innerHTML = "Product size must be a number!";       
        return false;
    }
}

function winemakerNameValidate(){
    const nameReg = /^[A-Za-z ]{2,}(?:[-'][A-Za-z ]+)*$/;
    if(winemaker.value === ""){
        return true;
    }
    if(winemaker.value.match(nameReg)){
        document.getElementById("demo4").style.color = "green"; 
        document.getElementById("demo4").innerHTML = "Valid name input.";
        return true;
    }
    else{
        document.getElementById("demo4").style.color = "red"; 
        document.getElementById("demo4").innerHTML = "Invalid name input!";
        return true;
    }
}

function vineyardValidate(){
    const addressReg = /^[A-Za-z0-9\s\.,'-]{2,}$/;
    if(vineyard.value === ""){
        return true;
    }
    if (vineyard.value.match(addressReg)){
        document.getElementById("demo4").style.color = "green"; 
        document.getElementById("demo4").innerHTML = "Valid vineyard input.";
        return true;
    }else{
        document.getElementById("demo3").style.color = "red"; 
        document.getElementById("demo3").innerHTML = "Invalid vineyard input!";
        return true;
    }
}

function overallValidate()
{
    var isFormValid = true; 
    var isWineryIDValid = winderyIDValidation();
    var isProductSizeValid = productSizeValidation();
    var isWinemakerNameValid = winemakerNameValidate();
    var isVineyardValid = vineyardValidate();

    if (!isProductSizeValid ||!isWinemakerNameValid || !isVineyardValid || !isWineryIDValid)
    {
        isFormValid = false;
    }

    if (isFormValid) {
        //alert("success");
        //update the winery.
        updateWinery();
        return true;
    } else {
        //testing purposes
        // var message = "isWineryNameValid " + wineryNameValidate() + 
        // "isProductSizeValid " + productSizeValidation() + 
        // "isVineyardValid " + vineyardValidate() +
        // "isWinemakerNameValid " + winemakerNameValidate() +
        // "isRegionSelected " + regionRadioSelected() +
        // "isVarietalSelected " + varietalRadioSelected();
        // alert(message);
        alert ("Cannot update winery!");
        return false;
    }
}

function clearAll() {
    wineryid.value = "";
    productSize.value = "";
    winemaker.value = "";
    vineyard.value = "";
    image.value = "";
  }

  function updateWinery(){
    var body = JSON.stringify({
        "type": "updateWinery",
        "wineryID":wineryID.value,
        "vineyard": vineyard.value,
        "productionSize": productSize.value,
        "winemaker": winemaker.value,
        "image" : image.value
    })
    console.log(body);
    let request = new XMLHttpRequest();
    var url = "http://localhost/COS221-Website/globals/API_Wines.php";
    request.open("POST",url,false);
    request.setRequestHeader("Content-type", "application/json");
    request.onreadystatechange = function(){
        if(request.readyState==4 && request.status == 200){
            console.log("Winery updated");
        }else{
            console.log("Error:"+request.responseText.message);
        }
    }
    request.send(body);  
}