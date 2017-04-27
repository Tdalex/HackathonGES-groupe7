
<div class="home-container align hidden" id="connexion_container">
  <div class="home-body col-md-3 animated fadeInLeft">
    <img class="home-logo" src="/src/img/home-logo.png">

    <!-- Formulaire -->
    <form action="" method="post" id="form_connexion">
      <div class="gfi-input home-input">
        <input type="hidden" name="type" value="signin" id="signin">
        <input name="mail" id="mail" type="text" class="gfi-input-text" required/>
        <span class="gfi-input-label">E-mail</span>
      </div>
      <div class="gfi-input home-input">
        <input name="mdp" id="mdp" type="password" name="" class="gfi-input-text" required/>
        <span class="gfi-input-label">Mot de passe</span>
      </div>
      <button class="btn gfi-btn gfi-btn-primary home-btn full-width" name="connect" id="connect">
          <span class="gfi-btn-span firstspan">Se connecter</span>
          <span class="gfi-btn-span secondspan">Se connecter</span>
      </button>
    <!-- Fin formulaire -->

    <div class="gfi-body-footer">
      <a class="home-cgu-link">CGU</a>
      <a id="inscription" class="home-subscribe-link">S'inscrire</a>
    </div>
  </div>
</div>
