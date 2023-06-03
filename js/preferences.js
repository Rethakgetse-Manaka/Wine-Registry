let changeThemeBtn = document.getElementById('change-theme-btn');

function toggleTheme(){
  let lightThemeEnabled = document.body.classList.toggle('light-theme');
  document.cookie = 'light-theme-enabled=' + lightThemeEnabled + '; path=/';
  
  let LogoImg = document.getElementById('Logo');
  let landingImg = document.getElementById('landing-image');
  if(lightThemeEnabled){
    // Set the expiration date to one year from now
    let expirationDate = new Date();
    expirationDate.setFullYear(expirationDate.getFullYear() + 1);
    // Set the theme cookie with an expiration date
    document.cookie = 'theme=light; path=/; expires=' + expirationDate.toUTCString();
    LogoImg.src = "img/CARPARADISE.jpg";
    landingImg.src = "img/Models/R8.png";
  }else{
    // Set the expiration date to one year from now
    let expirationDate = new Date();
    expirationDate.setFullYear(expirationDate.getFullYear() + 1);
    // Set the theme cookie with an expiration date
    document.cookie = 'theme=dark; path=/; expires=' + expirationDate.toUTCString();
    LogoImg.src = "img/Full_Logo.png";
    landingImg.src = "img/launch_page.jpg";
  }
}
if (changeThemeBtn) {
  changeThemeBtn.addEventListener('click',function(){
    toggleTheme();
  })
}




