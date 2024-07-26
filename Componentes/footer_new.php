<style>
  /* Reset para enlaces */
  a,
  a:hover,
  a:focus,
  a:active {
    text-decoration: none;
    outline: none;
    color: #6f6f6f;
    transition: color 0.2s ease-in-out;
  }

  a:hover,
  a:focus {
    color: #ffb606;
  }

  /* Reset para listas */
  ul {
    margin: 0;
    padding: 0;
    list-style: none;
  }

  /* Ajuste de imágenes */
  img {
    max-width: 100%;
    height: auto;
  }

  /* Estilos de sección */
  section {
    padding: 60px 0;
    min-height: 100vh;
  }

  /* Estilos del pie de página */
  .footer {
    padding: 100px 0 0;
    background-color: #030a16;
    color: #fff;
  }

  .footer .footer-content {
    width: 90%;
    margin: 0 auto !important;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
  }

  .footer .widget1 {
    display: flex;
    flex-direction: column;
  }

  .footer .logo-img {
    max-width: 200px;
  }

  .footer h5 {
    font-weight: 600;
    margin-bottom: 28px;
    font-size: 21px;
  }

  .footer .widget1 p {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.6);
    margin-top: 26px;
  }

  .footer .socialLinks {
    margin-top: 28px;
  }

  .footer .socialLinks ul {
    margin: 0;
    padding: 0;
  }

  .footer .socialLinks ul li {
    display: inline-block;
  }

  .footer .socialLinks ul li a {
    display: block;
    margin: 0 2px;
    width: 40px;
    height: 40px;
    background: #fafafa;
    border-radius: 50%;
    text-align: center;
    line-height: 40px;
    transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
  }

  .footer .socialLinks ul li a .fa-facebook-f {
    color: #4267b2;
  }

  .footer .socialLinks ul li a .fa-twitter {
    color: #1da1f2;
  }

  .footer .socialLinks ul li a .fa-instagram {
    color: #dd5044;
  }

  .footer .socialLinks ul li a .fa-linkedin-in {
    color: #0177b5;
  }

  .footer .socialLinks ul li a:hover {
    color: #fff;
  }

  .footer .socialLinks ul li a:hover .fa-facebook-f {
    background: #4267b2;
  }

  .footer .socialLinks ul li a:hover .fa-twitter {
    background: #1da1f2;
  }

  .footer .socialLinks ul li a:hover .fa-instagram {
    background: #dd5044;
  }

  .footer .socialLinks ul li a:hover .fa-linkedin-in {
    background: #0177b5;
  }

  .footer .widget2 .media {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
  }

  .footer .widget2 .media img {
    margin-right: 20px;
    max-width: 100px;
  }

  .footer .widget2 .media p {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.8);
    font-weight: 600;
    line-height: 26px;
    margin: 0;
  }

  .footer .widget2 .media span {
    font-size: 12px;
    color: #ffb606;
    text-transform: uppercase;
    margin-top: 15px;
  }

  .footer .widget3 ul,
  .footer .widget4 ul {
    padding: 0;
  }

  .footer .widget3 ul li,
  .footer .widget4 ul li {
    margin-bottom: 13px;
  }

  .footer .widget3 ul li a,
  .footer .widget4 ul li a {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.6);
    text-transform: capitalize;
    display: block;
    margin: 0;
  }

  .footer .widget3 ul li a:hover,
  .footer .widget4 ul li a:hover {
    color: #ffb606;
  }

  .footer .widget3 h5,
  .footer .widget4 h5 {
    margin-bottom: 22px;
    font-size: 21px;
  }

  /* Estilos para el copyright */
  .copyRightArea {
    margin-top: 50px;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    padding: 15px 0;
    text-align: center;
    background-color: #030a16;
    /* Same as footer background */
  }

  .copyRightArea p {
    color: rgba(255, 255, 255, 0.6);
    margin: 0;
  }
</style>

<footer class="footer">
  <div class="footer-content container">
    <div class="widget1">
      <div class="logo-img">
        <img src="img/logo-actual.webp" class="bn" alt="">
      </div>
      <p>Somos un centro de Psicología online. Si buscas psicólogo online, ponte en contacto con nostros y estaremos encantados de atenderte.</p>
      <div class="socialLinks">
        <ul>
          <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="#"><i class="fab fa-twitter"></i></a></li>
          <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
          <li><a href="#"><i class="fab fa-instagram"></i></a></li>
        </ul>
      </div>
    </div>
    <div class="widget2">
      <h5>Latest News</h5>
      <div class="media">
        <img class="img-fluid" src="https://i.ibb.co/CKNmhMX/blog1.jpg" alt="">
        <div class="media-body">
          <div class="content">
            <a href="#">
              <p>Did son unreserved themselves indulgence its</p>
            </a>
            <span>Aug 17, 2019</span>
          </div>
        </div>
      </div>
      <div class="media">
        <img class="img-fluid" src="https://i.ibb.co/m5yGbdR/blog2.jpg" alt="">
        <div class="media-body">
          <div class="content">
            <a href="#">
              <p>Rapturous am eagerness it as resolving household</p>
            </a>
            <span>Aug 17, 2019</span>
          </div>
        </div>
      </div>
    </div>
    <div class="widget3">
      <h5>Quick Links</h5>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Privacy</a></li>
        <li><a href="#">Skills</a></li>
        <li><a href="#">Career</a></li>
      </ul>
    </div>
    <div class="widget4">
      <h5>Other Links</h5>
      <ul>
        <li><a href="#">ThemeForest</a></li>
        <li><a href="#">GraphicRiver</a></li>
        <li><a href="#">CodeCanyon</a></li>
        <li><a href="#">VideoHive</a></li>
        <li><a href="#">RedPen</a></li>
        <li><a href="#">CodePen</a></li>
      </ul>
    </div>
  </div>
  <div class="copyRightArea">
    <p>&copy; Copyright All rights reserved 2024.</p>
  </div>
</footer>