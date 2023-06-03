window.addEventListener("load", () => {
  const loading = document.querySelector(".loading");
  loading.classList.add("loading-hidden");
});

function BrandsLoad() {
  let carlist = document.querySelector(".brand-wrapper");

  //1. Create the XMLHttpRequest Object
  let request = new XMLHttpRequest();
  var body = JSON.stringify({
    type: "getRegions",
    return: "*",
  });

  //I am using asynchronous because we want the cars to show as soons as the age is loaded.
  //2. create request
  request.open("POST", "http://localhost/5-31/API_Wines.php", true);
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let Q1 = JSON.parse(request.responseText);
      for (let i = 0; i < Q1.data.length; i++) {
        console.log(Q1);
        const html = `<div class="brand">
                    <img src="${Q1.data[i].Image}" alt="${Q1.data[i]}">
                    <h1>${Q1.data[i].RegionName}</h1>
                    <h2>${Q1.data[i].Country}</h2>
                    <h3> Climate: ${Q1.data[i].Climate}</h3>
                  </div>`;
        carlist.insertAdjacentHTML("beforeend", html);
      }
    } else {
      console.log("Error");
    }
  };

  //3. Send the request
  request.send(body);
}

function sort() {
  let carlist = document.querySelector(".brand-wrapper");
  carlist.innerHTML = "";
  let SortStyle = document.getElementById("filter-select-sort").value;
  let request = new XMLHttpRequest();
  var body = JSON.stringify({
    type: "getRegions",
    return: "*",
    order: SortStyle,
  });

  request.open("POST", "http://localhost/5-31/API_Wines.php", true);
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
        let Q1 = JSON.parse(request.responseText);
        for (let i = 0; i < Q1.data.length; i++) {
          console.log(Q1);
          const html = `<div class="brand">
                      <img src="${Q1.data[i].Image}" alt="${Q1.data[i]}">
                      <h1>${Q1.data[i].RegionName}</h1>
                      <h2>${Q1.data[i].Country}</h2>
                      <h3> Climate: ${Q1.data[i].Climate}</h3>
                    </div>`;
          carlist.insertAdjacentHTML("beforeend", html);
        }
      } else {
        console.log("Error");
      }
  };

  //3. Send the request
  request.send(body);
}
