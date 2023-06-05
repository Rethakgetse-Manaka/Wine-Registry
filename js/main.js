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
                        <li>Price: R${Q1.data[i]['Price']}</li>
                        <li>Bottle Size: ${Q1.data[i]['Bottle_Size']}ml</li>
                        <li>pH: ${Q1.data[i]['pH']}</li>
                        <li>Alcohol Content: ${Q1.data[i]['Alcohol_Content']}%</li>
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
    let input = document.getElementById("search-input").value;
    const carlist = document.querySelector('.car-wrapper');
    let SortStyle = document.getElementById('filter-select-sort').value;
    let filterby = document.getElementById('filter-select-filter').value;
    // console.log(input+SortStyle+filterby);
    var order = null;
    var search = null; 
    var sort = null;
    var filter = null;
    const searchbody = {};

    const prebody = {
        "type":"getWines",
        "return":"*"
    }
    

    if(SortStyle == "Price(Highest - Lowest)"){
        sort = "Price";
        order = "DESC"
    }else if(SortStyle == "Price(Lowest - Highest)"){
        sort = "Price";
        order = "ASC"
    }else if(SortStyle == "Alcohol Content(Highest - Lowest)"){
        sort = "Alcohol_Content";
        order = "DESC"
    }else if(SortStyle == "Alcohol Content(Lowest - Highest)"){
        sort = "Alcohol_Content";
        order = "ASC"
    }

    if(filterby == "red") {
        filter = "red";
    } else if(filterby == "white"){
        filter = "white";
    } else if(filterby == "rosé"){
        filter = "rose";
    } else if(filterby == "sparkling"){
        filter = "sparkling";
    } else if(filterby == "dessert"){
        filter = "dessert";
    } else if(filterby == "fortified"){
        filter = "fortified";
    }

    if (input != ''){
        search = input;
    }

    if (sort !== null) {
        prebody.sort = sort;
        prebody.order = order;
    }

    if (filter != null) {
        searchbody.filter = filter;
        prebody.search = searchbody;
    }

    if (search !== null) {
        searchbody.Name = search;
        prebody.search = searchbody;
    }

    console.log(prebody);
    const body = JSON.stringify(prebody);
    
    carlist.innerHTML = '';
    //1. Create the XMLHttpRequest Object
    let request = new XMLHttpRequest();
    
    // console.log(SortStyle);
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
                    <li>Price: R${Q1.data[i]['Price']}</li>
                    <li>Bottle Size: ${Q1.data[i]['Bottle_Size']}ml </li>
                    <li>pH: ${Q1.data[i]['pH']}</li>
                    <li>Alcohol Content: ${Q1.data[i]['Alcohol_Content']}%</li>
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
function showForm() {
  var fContainer = document.getElementById("formContainer");
  fContainer.innerHTML = "";

  var bContainer = document.getElementById("buttonContainer");
  bContainer.innerHTML = "";

  let request = new XMLHttpRequest();
  var body = JSON.stringify({
    type: "getWinery",
    return: "*",
  });
  request.open("POST", "http://localhost/5-31/API_Wines.php", false);
  var wineries = [];
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let Q1 = JSON.parse(request.responseText);
      for (let i = 0; i < Q1.data.length; i++) {
        wineries.push(Q1.data[i].WineryName);
      }
    } else {
      console.log("Error");
    }
  };
  request.send(body);

  var form = document.createElement("form");
  form.action = "#";
  form.method = "POST";
  form.style.border = "1px solid #ccc";

  // Create container div
  var container = document.createElement("div");
  container.className = "container";

  // Add heading
  var heading = document.createElement("p");
  heading.className = "heading";
  heading.textContent = "Add a Wine";
  container.appendChild(heading);

  // Add description
  var description = document.createElement("p");
  description.textContent = "Please fill in the form below to add a new wine.";
  container.appendChild(description);

  // Add horizontal rule
  var hr = document.createElement("hr");
  container.appendChild(hr);

  // Create label and input for Wine Name
  var wineNameLabel = document.createElement("label");
  wineNameLabel.htmlFor = "wineName";
  wineNameLabel.textContent = "Wine Name:";
  container.appendChild(wineNameLabel);

  var wineNameInput = document.createElement("input");
  wineNameInput.type = "text";
  wineNameInput.id = "wineName";
  wineNameInput.name = "wineName";
  container.appendChild(wineNameInput);
  container.appendChild(document.createElement("br"));
  container.appendChild(document.createElement("br"));
  // Create label and input for Price
  var priceLabel = document.createElement("label");
  priceLabel.htmlFor = "price";
  priceLabel.textContent = "Price:";
  container.appendChild(priceLabel);

  var priceInput = document.createElement("input");
  priceInput.type = "number";
  priceInput.step = "0.01";
  priceInput.id = "price";
  priceInput.name = "price";
  container.appendChild(priceInput);
  container.appendChild(document.createElement("br"));
  container.appendChild(document.createElement("br"));

  var wineryLabel = document.createElement("label");
  wineryLabel.htmlFor = "wineriesA";
  wineryLabel.textContent = "Wineries:";
  container.appendChild(wineryLabel);

  var winerySelect = document.createElement("select");
  winerySelect.type = "number";
  winerySelect.id = "wineriesA";
  winerySelect.name = "wineriesA";
  for (var i = 0; i < wineries.length; i++) {
    var option = document.createElement("option");
    option.value = wineries[i];
    option.textContent = wineries[i];
    winerySelect.appendChild(option);
  }

  container.appendChild(winerySelect);
  container.appendChild(document.createElement("br"));
  container.appendChild(document.createElement("br"));

  // Create label and input for Bottle Size
  var bottleSizeLabel = document.createElement("label");
  bottleSizeLabel.htmlFor = "bottleSize";
  bottleSizeLabel.textContent = "Bottle Size:";
  container.appendChild(bottleSizeLabel);

  var bottleSizeInput = document.createElement("input");
  bottleSizeInput.type = "number";
  bottleSizeInput.id = "bottleSize";
  bottleSizeInput.name = "bottleSize";
  container.appendChild(bottleSizeInput);
  container.appendChild(document.createElement("br"));
  container.appendChild(document.createElement("br"));
  // Create label and select for Grape Varietal
  var grapeVarietalLabel = document.createElement("label");
  grapeVarietalLabel.htmlFor = "grapeVarietal";
  grapeVarietalLabel.textContent = "Grape Varietal:";
  container.appendChild(grapeVarietalLabel);

  var grapeVarietalSelect = document.createElement("select");
  grapeVarietalSelect.id = "grapeVarietal";
  grapeVarietalSelect.name = "grapeVarietal";

  var grapeVarietalOptions = [
    "Cabernet Sauvignon",
    "Shiraz",
    "Sangiovese",
    "Chardonnay",
    "Sauvignon Blanc",
    "Riesling",
    "Pinot Grigio",
    "Gewürztraminer",
    "Malbec",
    "Viognier",
    "Grenache",
    "Cinsault",
  ];

  for (var i = 0; i < grapeVarietalOptions.length; i++) {
    var option = document.createElement("option");
    option.value = grapeVarietalOptions[i];
    option.textContent = grapeVarietalOptions[i];
    grapeVarietalSelect.appendChild(option);
  }

  container.appendChild(grapeVarietalSelect);
  container.appendChild(document.createElement("br"));
  container.appendChild(document.createElement("br"));

  var alcoholLabel = document.createElement("label");
  alcoholLabel.htmlFor = "alcohol";
  alcoholLabel.textContent = "Alcohol Content:";
  container.appendChild(alcoholLabel);

  var alcoholInput = document.createElement("input");
  alcoholInput.type = "number";
  alcoholInput.step = "0.01";
  alcoholInput.id = "alcohol";
  alcoholInput.name = "alcohol";
  container.appendChild(alcoholInput);
  container.appendChild(document.createElement("br"));
  container.appendChild(document.createElement("br"));

  var densityLabel = document.createElement("label");
  densityLabel.htmlFor = "density";
  densityLabel.textContent = "Density:";
  container.appendChild(densityLabel);

  var densityInput = document.createElement("input");
  densityInput.type = "number";
  densityInput.step = "0.001";
  densityInput.id = "density";
  densityInput.name = "density";
  container.appendChild(densityInput);
  container.appendChild(document.createElement("br"));
  container.appendChild(document.createElement("br"));

  var residualLabel = document.createElement("label");
  residualLabel.htmlFor = "residual";
  residualLabel.textContent = "Residual Sugar:";
  container.appendChild(residualLabel);

  var residualInput = document.createElement("input");
  residualInput.type = "number";
  residualInput.id = "residual";
  residualInput.name = "residual";
  container.appendChild(residualInput);
  container.appendChild(document.createElement("br"));
  container.appendChild(document.createElement("br"));

  var acidLabel = document.createElement("label");
  acidLabel.htmlFor = "acid";
  acidLabel.textContent = "Fixed Acidity:";
  container.appendChild(acidLabel);

  var acidInput = document.createElement("input");
  acidInput.type = "number";
  acidInput.step = "0.1";
  acidInput.id = "acid";
  acidInput.name = "acid";
  container.appendChild(acidInput);
  container.appendChild(document.createElement("br"));
  container.appendChild(document.createElement("br"));

  var pHLabel = document.createElement("label");
  pHLabel.htmlFor = "pH";
  pHLabel.textContent = "pH:";
  container.appendChild(pHLabel);

  var pHInput = document.createElement("input");
  pHInput.type = "number";
  pHInput.step = "0.01";
  pHInput.id = "pH";
  densityInput.name = "pH";
  container.appendChild(pHInput);
  container.appendChild(document.createElement("br"));
  container.appendChild(document.createElement("br"));
  // Create label and input for Image
  var imageLabel = document.createElement("label");
  imageLabel.htmlFor = "image";
  imageLabel.textContent = "Image:";
  container.appendChild(imageLabel);

  var imageInput = document.createElement("input");
  imageInput.type = "text";
  imageInput.id = "image";
  imageInput.name = "image";
  container.appendChild(imageInput);
  container.appendChild(document.createElement("br"));
  container.appendChild(document.createElement("br"));
  // Add container div to form
  form.appendChild(container);

  var wineTypeLabel = document.createElement("label");
  wineTypeLabel.htmlFor = "wineType";
  wineTypeLabel.textContent = "Wine Type:";
  container.appendChild(wineTypeLabel);

  var wineTypeSelect = document.createElement("select");
  wineTypeSelect.id = "wineType";
  wineTypeSelect.name = "wineType";

  var wineTypeOptions = [
    "Dessert Wine",
    "Red Wine",
    "White Wine",
    "Rose Wine",
    "Sparkling Wine",
  ];

  for (var i = 0; i < wineTypeOptions.length; i++) {
    var option = document.createElement("option");
    option.value = wineTypeOptions[i];
    option.textContent = wineTypeOptions[i];
    wineTypeSelect.appendChild(option);
  }

  container.appendChild(wineTypeSelect);
  container.appendChild(document.createElement("br"));
  container.appendChild(document.createElement("br"));

  // Create container for dynamic inputs
  var dynamicInputsContainer = document.createElement("div");
  dynamicInputsContainer.setAttribute("id", "dynamicInputsContainer");
  container.appendChild(dynamicInputsContainer);

  // Add event listener to wineTypeSelect
  wineTypeSelect.addEventListener("change", function () {
    // Remove existing dynamic inputs
    while (dynamicInputsContainer.firstChild) {
      dynamicInputsContainer.firstChild.remove();
    }

    // Create dynamic inputs based on selected wine type
    var selectedWineType = wineTypeSelect.value;

    if (selectedWineType === "Dessert Wine") {
      createTextInput(dynamicInputsContainer, "Style", "style");
    } else if (selectedWineType === "Red Wine") {
      createTextInput(dynamicInputsContainer, "Tannin", "tannin");
    } else if (selectedWineType === "Rose Wine") {
      createTextInput(
        dynamicInputsContainer,
        "Percentage White",
        "percentageWhite"
      );
      createTextInput(
        dynamicInputsContainer,
        "Percentage Red",
        "percentageRed"
      );
    } else if (selectedWineType === "White Wine") {
      createTextInput(dynamicInputsContainer, "Shade", "shade");
    } else if (selectedWineType === "Sparkling Wine") {
      createTextInput(
        dynamicInputsContainer,
        "Carbon Content",
        "carbonContent"
      );
    }
  });

  // Add form to the form container
  var formContainer = document.getElementById("formContainer");
  formContainer.appendChild(form);

  var clearButton = document.createElement("button");
  clearButton.type = "button";
  clearButton.className = "cancelbtn";
  clearButton.textContent = "Clear";
  clearButton.addEventListener("click", function () {
    document.getElementById("wineName").value = "";
    document.getElementById("price").value = "";
    document.getElementById("wineriesA").selectedIndex = 0;
    document.getElementById("bottleSize").value = "";
    document.getElementById("grapeVarietal").selectedIndex = 0;
    document.getElementById("wineType").selectedIndex = 0;
    document.getElementById("image").value = "";
    document.getElementById("alcohol").value = "";
    document.getElementById("density").value = "";
    document.getElementById("residual").value = "";
    document.getElementById("acid").value = "";
    document.getElementById("pH").value = "";
    var dynamicInputsContainer = document.getElementById(
      "dynamicInputsContainer"
    );
    while (dynamicInputsContainer.firstChild) {
      dynamicInputsContainer.firstChild.remove();
    }
  });

  var addButton = document.createElement("button");
  addButton.type = "submit";
  addButton.id = "btnSignUp";
  addButton.name = "submit";
  addButton.className = "signupbtn";
  addButton.textContent = "Add Wine";

  var goBackButton = document.createElement("button");
  goBackButton.type = "button";
  goBackButton.className = "backBtn";
  goBackButton.textContent = "Go Back";
  goBackButton.addEventListener("click", function () {
    var mainDiv = document.getElementById("formContainer");
    var subDiv = document.getElementById("buttonContainer");
    mainDiv.innerHTML = "";
    subDiv.innerHTML = "";
  });

  addButton.addEventListener("click", function () {
    event.preventDefault();
    var wineName = document.getElementById("wineName").value;
    var price = document.getElementById("price").value;
    var winery = document.getElementById("wineriesA").value;
    var bottleSize = document.getElementById("bottleSize").value;
    var grapeVarietal = document.getElementById("grapeVarietal").value;
    var wineType = document.getElementById("wineType").value;
    var image = document.getElementById("image").value;
    var alcohol = document.getElementById("alcohol").value;
    var density = document.getElementById("density").value;
    var residual = document.getElementById("residual").value;
    var acid = document.getElementById("acid").value;
    var pH = document.getElementById("pH").value;
    var wineryID = "";
    var varietalID = "";

    let request = new XMLHttpRequest();
    var body = JSON.stringify({
      type: "getWineryID",
      name: winery,
      return: "*",
    });

    request.open("POST", "http://localhost/5-31/API_Wines.php", false);
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        let Q1 = JSON.parse(request.responseText);
        wineryID = Q1.data[0].WineryID;
      } else {
        console.log("Error");
      }
    };
    request.send(body);

    let request1 = new XMLHttpRequest();
    var body1 = JSON.stringify({
      type: "getVarietalID",
      name: grapeVarietal,
      return: "*",
    });

    request1.open("POST", "http://localhost/5-31/API_Wines.php", false);
    request1.onreadystatechange = function () {
      if (request1.readyState == 4 && request1.status == 200) {
        let Q1 = JSON.parse(request1.responseText);
        varietalID = Q1.data[0].VarietalID;
      } else {
        console.log("Error");
      }
    };
    request1.send(body1);

    var wineTypeValue = {};
    

    if (
      wineName.trim() === "" ||
      price.trim() === "" ||
      winery.trim() === "" ||
      bottleSize.trim() === "" ||
      grapeVarietal.trim() === "" ||
      wineType.trim() === "" ||
      image.trim() === "" ||
      alcohol.trim() === "" ||
      density.trim() === "" ||
      residual.trim() === "" ||
      acid.trim() === "" ||
      pH.trim() === ""
    ) {
      alert("Some informarion is missing, please fill in all the fields.");
    } else {
      if (wineType == "Dessert Wine") {
        var style = document.getElementById("style").value;
        wineTypeValue.Style = style;
        console.log(style);
      } else if (wineType == "Red Wine") {
        var tannin = document.getElementById("tannin").value;
        wineTypeValue.Tannin = tannin;
        console.log(tannin);
      } else if (wineType == "Rose Wine") {
        var percentageWhite = document.getElementById("percentageWhite").value;
        var percentageRed = document.getElementById("percentageRed").value;
        wineTypeValue.Percentage_White = percentageWhite;
        wineTypeValue.Percentage_Red = percentageRed;
        console.log(percentageWhite);
        console.log(percentageRed);
      } else if (wineType == "White Wine") {
        var shade = document.getElementById("shade").value;
        wineTypeValue.Shade = shade;
        console.log(shade);
      } else if (wineType == "Sparkling Wine") {
        var carbonContent = document.getElementById("carbonContent").value;
        wineTypeValue.CarbonContent = carbonContent;
        console.log(carbonContent);
      }
      
      let req = new XMLHttpRequest();
      var insertBody = JSON.stringify({
        type: "insertWine",
        wName: wineName,
        wPrice: price,
        wbottleSize: bottleSize,
        wImage: image,
        wWineryID: wineryID,
        wVarietalID: varietalID,
        WineType: wineType,
        WineTypeValue: wineTypeValue,
        wAlcoholContent: alcohol,
        wDensity: density,
        wResidualSugar: residual,
        wFixedAcidity: acid,
        wpH: pH
      });
      console.log(insertBody);
      req.open("POST", "http://localhost/5-31/API_Wines.php", false);
      req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
          let Q1 = JSON.parse(req.responseText);
          if (Q1.message == "Something went wrong") {
            alert("There is a duplicate insert.");
          }else if(Q1.message == "Wine added"){
            alert("The wine was successfully added.");
            var mainDiv = document.getElementById("formContainer");
            var subDiv = document.getElementById("buttonContainer");
            mainDiv.innerHTML = "";
            subDiv.innerHTML = "";
            PageLoad();
          }
        } else {
          console.log("Error");
        }
      };
      req.send(insertBody);
    }
  });

  // Create clearfix div for buttons
  var clearfix = document.createElement("div");
  clearfix.className = "clearfix";

  clearfix.appendChild(clearButton);
  clearfix.appendChild(addButton);
  clearfix.appendChild(goBackButton);

  var buttonContainer = document.getElementById("buttonContainer");
  buttonContainer.appendChild(clearfix);
}

function createTextInput(container, label, name) {
  var textInputLabel = document.createElement("label");
  textInputLabel.htmlFor = name;
  textInputLabel.textContent = label;
  container.appendChild(textInputLabel);

  var textInput = document.createElement("input");
  textInput.type = "text";
  textInput.id = name;
  textInput.name = name;
  container.appendChild(textInput);

  container.appendChild(document.createElement("br"));
  container.appendChild(document.createElement("br"));
}

function updateWine() {
  var formContainer = document.getElementById("formContainer");
  formContainer.innerHTML = "";

  var bContainer = document.getElementById("buttonContainer");
  bContainer.innerHTML = "";

  var form = document.createElement("form");
  form.action = "#";
  form.method = "POST";
  form.style.border = "1px solid #ccc";

  var container = document.createElement("div");
  container.className = "container";

  var heading = document.createElement("p");
  heading.className = "heading";
  heading.textContent = "Update a Wine";
  container.appendChild(heading);

  var description = document.createElement("p");
  description.textContent = "Please fill in the form below to update a new wine.";
  container.appendChild(description);

  var hr = document.createElement("hr");
  container.appendChild(hr);

  var wineLabel = document.createElement("label");
  wineLabel.htmlFor = "uWine";
  wineLabel.textContent = "Wine ID:";
  container.appendChild(wineLabel);

  var wineInput = document.createElement("input");
  wineInput.type = "text";
  wineInput.id = "uWine";
  wineInput.name = "uWine";
  container.appendChild(wineInput);

  var priceLabel = document.createElement("label");
  priceLabel.htmlFor = "uPrice";
  priceLabel.textContent = "Price:";
  container.appendChild(priceLabel);

  var priceInput = document.createElement("input");
  priceInput.type = "number";
  priceInput.step = "0.01";
  priceInput.id = "uPrice";
  priceInput.name = "uPrice";
  container.appendChild(priceInput);

  var imageLabel = document.createElement("label");
  imageLabel.htmlFor = "uImage";
  imageLabel.textContent = "Image:";
  container.appendChild(imageLabel);

  var imageInput = document.createElement("input");
  imageInput.type = "text";
  imageInput.id = "uImage";
  imageInput.name = "uImage";
  container.appendChild(imageInput);

  var clearButton = document.createElement("button");
  clearButton.type = "button";
  clearButton.className = "cancelbtn";
  clearButton.textContent = "Clear";
  clearButton.addEventListener("click", function () {
    document.getElementById("uPrice").value = "";
    document.getElementById("uImage").value = "";
  });

  var addButton = document.createElement("button");
  addButton.type = "submit";
  addButton.id = "btnSignUp";
  addButton.name = "submit";
  addButton.className = "signupbtn";
  addButton.textContent = "Add Wine";
  addButton.addEventListener("click", function () {
    event.preventDefault();
    var wine = document.getElementById("uWine").value;
    var newImage = document.getElementById("uImage").value;
    var price = document.getElementById("uPrice").value;

    if(wine == ""){
      alert("Please fill in all the required fields.");
    }else{
      let req = new XMLHttpRequest();
      var updateBody = JSON.stringify({
        type: "updateWine",
        wineID: wine,
        price: price,
        image: newImage
      });
      req.open("POST", "http://localhost/5-31/API_Wines.php", false);
      req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
          let Q1 = JSON.parse(req.responseText);
          if (Q1.message == "Something went wrong" || Q1.message == "Missing values") {
            alert("There is a duplicate insert.");
          }else if(Q1.message == "Wine updated"){
            alert("The update was successful.");
            var mainDiv = document.getElementById("formContainer");
            var subDiv = document.getElementById("buttonContainer");
            mainDiv.innerHTML = "";
            subDiv.innerHTML = "";
            PageLoad();
          }
        } else {
          console.log("Error");
        }
      };
      req.send(updateBody);
    }
  });
  var goBackButton = document.createElement("button");
  goBackButton.type = "button";
  goBackButton.className = "backBtn";
  goBackButton.textContent = "Go Back";
  goBackButton.addEventListener("click", function () {
    var mainDiv = document.getElementById("formContainer");
    var subDiv = document.getElementById("buttonContainer");
    mainDiv.innerHTML = "";
    subDiv.innerHTML = "";
  });

  var clearfix = document.createElement("div");
  clearfix.className = "clearfix";

  clearfix.appendChild(clearButton);
  clearfix.appendChild(addButton);
  clearfix.appendChild(goBackButton);

  var buttonContainer = document.getElementById("buttonContainer");
  buttonContainer.appendChild(clearfix);

  form.appendChild(container);
  
  formContainer.appendChild(form);
}

function toggleActive() {
    const links = document.querySelectorAll('.nav-link'); // get all the nav links
    links.forEach(link => link.classList.remove('active')); // remove active class from all links
  
    this.classList.add('active'); // add active class to the clicked link
  }
  
  const links = document.querySelectorAll('.nav-link'); // get all the nav links
  links.forEach(link => link.addEventListener('click', toggleActive)); // add event listener to each link 
