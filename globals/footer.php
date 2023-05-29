<footer id ="footer">
    <section class="footer-container">
        <div class="about">
            <h3>About Us</h3>
            <p>Well done it works</p>
        </div>  
        <div class="services">
            <h3>Services</h3>
            <ul>
                <li><a href="">Find a wine</a></li>
                <li><a href="">Wine Destinations</a></li>
                <li><a href="">Wine Prices</a></li>
                <li><a href="">Reviews</a></li>
            </ul>
        </div>
        <div class="contact">
            <h3>Contact</h3>
            <ul>
                <li><a href="">Address: 123 Main Street Anytown, USA 12345</a></li>
                <li><a href="">Phone: +1 (555) 867-5309</a></li>
                <li><a href="">Email: WineCompany@wine.com</a></li>
            </ul>
        </div>
    </section>
    <section class="copyright">Copyright &copy; Company Name 2022</section>
</footer>


<style>
    *{
        margin:0;
        padding: 0;
    }
    #Save-Theme-Button{
        background-color: grey;
        color: black;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }
    .light-theme #Save-Theme-Button{
        background-color: black;
        color: white;
        border-radius: 5px;
    }
    .footer-container {
        display: flex;
        gap: 20px;
        padding: 45px 15px;
        max-width: 1000px;
        margin: 0 auto;
    }
    footer {
        background-color:#800000;
        color: white;
        display: flex;
        flex-direction: column;
    }
    .light-theme footer {
        color: black;
        background-color: white;
        display: flex;
        flex-direction: column;
        font-weight: bold;
    }
    .about {
        flex-grow: 1;
        flex-basis: 100%;
    }
    .light-theme ul li a {
        color:black;
    }
    .light-theme button{
        color: black;
    }
    .services {
        flex-grow: 1;
        flex-basis: 70%;
    }
    .services ul{
        list-style: none;
        line-height: 1.6;
    }
    .services a{
        text-decoration: none;
        color: white;
    }
    .services a:hover{
        text-decoration: underline;
    }
    .contact {
        flex-grow: 1;
        flex-basis: 100%;
    }
    .contact ul{
        list-style: none;
        line-height: 2;
        
    }
    .contact a{
        text-decoration: none;
        color: white;
    }
    .contact a:hover{
        text-decoration: none;
        text-decoration: underline;
    }
    .container h3{
        margin-bottom:20 px;
        font-size: 30px;
    }
    .copyright{
        padding: 15px 0;
        text-align: center;
        border-top: 1px solid grey;
    }

    @media (max-width: 768px){
        .footer-container {
            flex-direction: column;
        }
    }
.switch {
  position: relative;
  display: inline-block;
  width: 46px;
  height: 20px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  border-radius: 20px;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 12px;
  width: 12px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}
</style>
