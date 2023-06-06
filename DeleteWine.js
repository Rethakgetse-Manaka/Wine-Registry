var wineryid = document.getElementById("wineryID");
wineryid.addEventListener("keyup", winderyIDValidation);

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



function overallValidate()
{
    var isFormValid = true; 
    var isWineryIDValid = winderyIDValidation();
    

    if (!isWineryIDValid)
    {
        isFormValid = false;
    }

    if (isFormValid) {
        //alert("success");
        var confirmation = confirm("Do you want to proceed?");

        if (confirmation) {
        // User clicked "Yes"
        console.log("User chose Yes");
            DeleteWinery();
            clearAll();
            return true;
        } else {
        // User clicked "No" or closed the dialog
            console.log("User chose No or canceled");
            return false;
        }
        //update the winery.
        
    } else {
        //testing purposes
        // var message = "isWineryNameValid " + wineryNameValidate() + 
        // "isProductSizeValid " + productSizeValidation() + 
        // "isVineyardValid " + vineyardValidate() +
        // "isWinemakerNameValid " + winemakerNameValidate() +
        // "isRegionSelected " + regionRadioSelected() +
        // "isVarietalSelected " + varietalRadioSelected();
        // alert(message);
        alert ("Cannot Delete Winery! Fill in all details");
        return false;
    }
}

function clearAll() {
    wineryid.value = "";
  }

  function DeleteWinery(){
    var body = JSON.stringify({
        "type": "deleteWinery",
        "wineryID":wineryID.value
    })
    console.log(body);
    let request = new XMLHttpRequest();
    var url = "http://localhost/COS221-Website/globals/API_Wines.php";
    request.open("POST",url,false);
    request.setRequestHeader("Content-type", "application/json");
    request.onreadystatechange = function(){
        if (request.readyState === 4 && request.status === 200) {
            var response = JSON.parse(request.responseText);
            if (response.message === "Winery has wines associated with it") {
              alert("Winery has wines associated with it");
            }
            console.log("Winery updated");
        }else{
            console.log("Error:"+request.responseText.message);
        }
        var response = JSON.parse(request.responseText);
        if (response.message === "Winery doesn't exist") {
            alert("Winery doesn't exist");
        }
    }
    request.send(body);  
}