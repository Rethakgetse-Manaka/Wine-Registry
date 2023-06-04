var wineryName = document.getElementById("wineryName");
wineryName.addEventListener("keyup", wineryNameValidate);

var productSize = document.getElementById("productionSize");
productSize.addEventListener("keyup", productSizeValidation);

var vineyard = document.getElementById("vineyard");
vineyard.addEventListener("keyup", vineyardValidate);

var winemaker = document.getElementById("winemaker");
winemaker.addEventListener("keyup", winemakerNameValidate);

function wineryNameValidate(){
    const nameReg = /^[A-Za-z]{2,}(?:[-'][A-Za-z]+)*$/;
    if(wineryName.value === "")
    {
        document.getElementById("demo1").style.color = "red"; 
        document.getElementById("demo1").innerHTML = "Name must be filled out!"; 
        return false;      
    }
    else if(wineryName.value.match(nameReg))
    {
        document.getElementById("demo1").style.color = "green"; 
        document.getElementById("demo1").innerHTML = "Valid name input.";
        return true;
    }else{
        document.getElementById("demo1").style.color = "red"; 
        document.getElementById("demo1").innerHTML = "Invalid name input!";
        return true;
    }
}

function productSizeValidation(){
    const numReg = /^[0-9]+$/;

    if(productSize.value === "")
    {
        document.getElementById("demo2").style.color = "red"; 
        document.getElementById("demo2").innerHTML = "Product must be filled out!"; 
        return false;      
    }
    else if(productSize.value.match(numReg))
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

function vineyardValidate(){
    const nameReg = /^[A-Za-z]{2,}(?:[-'][A-Za-z]+)*$/;
    if(vineyard.value === "")
    {
        document.getElementById("demo3").style.color = "red"; 
        document.getElementById("demo3").innerHTML = "Vineyard must be filled out!"; 
        return false;      
    } else if(vineyard.value.match(nameReg)){
        document.getElementById("demo3").style.color = "green"; 
        document.getElementById("demo3").innerHTML = "Valid vineyard name input.";
        return true;
    }
    else{
        document.getElementById("demo3").style.color = "red"; 
        document.getElementById("demo3").innerHTML = "Invalid vineyard name input!";
        return true;
    }
}

function winemakerNameValidate(){
    const nameReg = /^[A-Za-z]{2,}(?:[-'][A-Za-z]+)*$/;
    if(winemaker.value === "")
    {
        document.getElementById("demo4").style.color = "red"; 
        document.getElementById("demo4").innerHTML = "Name must be filled out!"; 
        return false;      
    }else if(winemaker.value.match(nameReg)){
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

//checking radiobuttons selected
function regionRadioSelected(){
    var regionRadios = document.getElementsByName('region');
    var isRegionSelected = false;

    for (var i = 0; i < regionRadios.length; i++) {
        if (regionRadios[i].checked) {
            isRegionSelected = true;
            break;
        }
    }

    if (!isRegionSelected) {
        //alert('Please select a region.');
        document.getElementById("demo6").style.color = "red"; 
        document.getElementById("demo6").innerHTML = "Region must be selected!"; 
        return false; // Prevent 
    }
    else if (isRegionSelected){
        document.getElementById("demo5").style.color = "green"; 
        document.getElementById("demo5").innerHTML = "Selected."; 
        return true;
    }
}

function varietalRadioSelected(){
    var varietalRadios = document.getElementsByName('varietal');
    var isVarietalSelected = false;

    for (var i = 0; i < varietalRadios.length; i++) {
        if (varietalRadios[i].checked) {
            isVarietalSelected = true;
            break;
        }
    }

    if (!isVarietalSelected) {
        //alert('Please select a region.');
        document.getElementById("demo5").style.color = "red"; 
        document.getElementById("demo5").innerHTML = "Grape Varietal must be selected!"; 
        return false; // Prevent 
    }
    else if (isVarietalSelected){
        document.getElementById("demo5").style.color = "green"; 
        document.getElementById("demo5").innerHTML = "Selected."; 
        return true;
    }
}

function overallValidate()
{
    var isFormValid = true; 
    
    var isWineryNameValid = wineryNameValidate();
    var isProductSizeValid = productSizeValidation();
    var isVineyardValid = vineyardValidate();
    var isWinemakerNameValid = winemakerNameValidate();
    var isRegionSelected = regionRadioSelected();
    var isVarietalSelected = varietalRadioSelected();

    //Fail check
    if (
        !isWineryNameValid ||
        !isProductSizeValid ||
        !isVineyardValid ||
        !isWinemakerNameValid ||
        !isRegionSelected ||
        !isVarietalSelected)
    {
        isFormValid = false;
    }

    // If all validations passed, add the new wine to the database
    if (isFormValid) {
        //alert("success");
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
        return false;
    }
}

function clearAll(){
    wineryName.innerHTML="";
    vineyard.innerHTML="";
    productSize.innerHTML="";
    winemaker.innerHTML="";
    varietalRadios.innerHTML="";
    regionRadios.innerHTML="";
}
