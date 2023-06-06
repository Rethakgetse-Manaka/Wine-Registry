var wineryName = document.getElementById("wineryName");
wineryName.addEventListener("keyup", wineryNameValidate);

var productSize = document.getElementById("productionSize");
productSize.addEventListener("keyup", productSizeValidation);

var vineyard = document.getElementById("vineyard");
vineyard.addEventListener("keyup", vineyardValidate);

var winemaker = document.getElementById("winemaker");
winemaker.addEventListener("keyup", winemakerNameValidate);

var varietalRadios = document.getElementsByName('varietal');
var regionRadios = document.getElementsByName('region');

var image = document.getElementById('image');
image.addEventListener("keyup", imageUrlValidate);

function wineryNameValidate(){
    const nameReg = /^[A-Za-z ]{2,}(?:[-'][A-Za-z ]+)*$/;

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
        return false;
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
    const addressReg = /^[A-Za-z0-9\s\.,'-]{2,}$/;

    if(vineyard.value === "")
    {
        document.getElementById("demo3").style.color = "red"; 
        document.getElementById("demo3").innerHTML = "Vineyard must be filled out!"; 
        return false;      
    }else if (vineyard.value.match(addressReg)){
        document.getElementById("demo3").style.color = "green"; 
        document.getElementById("demo3").innerHTML = "Valid vineyard input.";
        return true;
    }else{
        document.getElementById("demo3").style.color = "red"; 
        document.getElementById("demo3").innerHTML = "Invalid vineyard input!";
        return false;
    }
}

function winemakerNameValidate(){
    const nameReg = /^[A-Za-z ]{2,}(?:[-'][A-Za-z ]+)*$/;

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
        return false;
    }
}

function imageUrlValidate(){
    //const imageUrlRegEx = /^data:image\/[a-zA-Z+.-]+;base64,[\w+/=]+$/;
    //const isImageUrl = imageUrlRegEx.test(image);
    //console.log(isImageUrl); // true

    if(image.value === "")
    {
        document.getElementById("demo6").style.color = "red"; 
        document.getElementById("demo6").innerHTML = "Image URL must be filled out!"; 
        return false;      
    }else{
        return true;
    }
    //else if(imageUrlRegEx.test(image.value)){
    //     document.getElementById("demo6").style.color = "green"; 
    //     document.getElementById("demo6").innerHTML = "Valid URL input.";
    //     return true;
    // }
    // else{
    //     document.getElementById("demo6").style.color = "red"; 
    //     document.getElementById("demo6").innerHTML = "Invalid URL input!";
    //     return false;
    // }
}

//checking radiobuttons selected
function regionRadioSelected(){
    
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
        alert("success");
        InsertWinery();
        return true;
    } else {
        //testing purposes
        // var message = "isWineryNameValid " + wineryNameValidate() + 
        // "isProductSizeValid " + productSizeValidation() + 
        // "isVineyardValid " + vineyardValidate() +
        // "isWinemakerNameValid " + winemakerNameValidate() +
        // "isRegionSelected " + regionRadioSelected() +
        // "isVarietalSelected " + varietalRadioSelected();
        //alert(message);
        alert("Cannot add the wine!");
        return false;
    }
}

function extractSelection() {
    // Get the selected varietal
    var varietalOptions = document.getElementsByName("varietal");
    var selectedVarietal = "";
    for (var i = 0; i < varietalOptions.length; i++) {
        if (varietalOptions[i].checked) {
        selectedVarietal = varietalOptions[i].value;
        break;
        }
    }
    
    // Get the selected region
    var regionOptions = document.getElementsByName("region");
    var selectedRegion = "";
    for (var i = 0; i < regionOptions.length; i++) {
        if (regionOptions[i].checked) {
        selectedRegion = regionOptions[i].value;
        break;
        }
        }
        return [selectedVarietal, selectedRegion];  
    }

function clearAll() {
    wineryName.value = "";
    vineyard.value = "";
    productSize.value = "";
    winemaker.value = "";
  
    var varietalRadios = document.getElementsByName('varietal');
    for (var i = 0; i < varietalRadios.length; i++) {
      varietalRadios[i].checked = false;
    }
  
    var regionRadios = document.getElementsByName('region');
    for (var i = 0; i < regionRadios.length; i++) {
      regionRadios[i].checked = false;
    }
}

function InsertWinery(){
    var body = JSON.stringify({
        "type": "insertWinery",
        "wineryName": wineryName.value,
        "vineyard": vineyard.value,
        "productionSize": productSize.value,
        "winemaker": winemaker.value,
        "licensed":1,
        "varietal": extractSelection()[0],
        "region": extractSelection()[1],
        "image" : image.value
        })
        console.log(body);
        let request = new XMLHttpRequest();
        var url = "http://localhost/COS221/globals/API_Wines.php";
        request.open("POST",url,false);
        request.setRequestHeader("Content-type", "application/json");
        request.onreadystatechange = function(){
        if(request.readyState==4 && request.status == 200){
            console.log("Winery added");
        }else{
            console.log("Error:"+request.responseText.message);
        }
        }
        request.send(body);  
    }