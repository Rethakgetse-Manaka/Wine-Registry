var wineryid = document.getElementById("wineryID");
wineryid.addEventListener("keyup", winderyIDValidation);

var productSize = document.getElementById("productionSize");
productSize.addEventListener("keyup", productSizeValidation);

var winemaker = document.getElementById("winemaker");
winemaker.addEventListener("keyup", winemakerNameValidate);

var vineyard = document.getElementById("vineyard");
vineyard.addEventListener("keyup", vineyardValidate);

function winderyIDValidation(){
    const numReg = /^[0-9]+$/;

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

    if(vineyard.value === "")
    {
        document.getElementById("demo3").style.color = "red"; 
        document.getElementById("demo3").innerHTML = "Vineyard must be filled out!"; 
        return false;      
    }else if (vineyard.value.match(addressReg)){
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
    
    var isProductSizeValid = productSizeValidation();
    var isWinemakerNameValid = winemakerNameValidate();
    var isVineyardValid = vineyardValidate();

    if (!isProductSizeValid ||!isWinemakerNameValid || !isVineyardValid)
    {
        isFormValid = false;
    }

    if (isFormValid) {
        //alert("success");
        //update the winery.
        var body = JSON.stringify({
            "type": "getWinery",
            "return":"*"
        })
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
    wineryID.value = "";
    productSize.value = "";
    winemaker.value = "";
  }