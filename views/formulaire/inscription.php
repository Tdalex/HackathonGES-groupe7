
<div class="home-container align" id="home-container">
  <div class="home-body col-md-4 animated fadeInLeft">
    <img class="home-logo" src="/src/img/home-logo.png">

    <!-- Formulaire -->
    <form action="#" method="post" id="form_inscription">
      <input type="hidden" name="type" id="signup" value="signup">

      <!-- Step 1 -->
      <div id="step1">

        <div class="gfi-input home-input">
          <input name="name" id="name" type="text" class="gfi-input-text" required/>
          <span class="gfi-input-label">Nom</span>
        </div>

        <div class="gfi-input home-input">
          <input name="surname" id="surname" type="text" class="gfi-input-text" required/>
          <span class="gfi-input-label">Prénom</span>
        </div>

        <div style="text-align: left; padding: 15px 10px 0;">
          <span style="color: rgba(41, 41, 41, 0.39);">Sexe</span>
          <div style="float: right;" id="gender">
            <input type="radio" name="gender" value="0" style="vertical-align: middle; margin: 0 5px;"><span style="vertical-align: middle;">Homme</span>
            <input type="radio" name="gender" value="1" style="vertical-align: middle; margin: 0 5px;"><span style="vertical-align: middle;">Femme</span>
          </div>
        </div>

        <div class="gfi-input home-input">
          <input type="date" name="birthday" id="birthday" class="gfi-input-text" required/>
          <span class="gfi-input-label">Date de naissance</span>
        </div>

        <div class="gfi-input home-input">
          <input name="email" id="email" type="email" class="gfi-input-text" required/>
          <span class="gfi-input-label">E-mail</span>
        </div>

        <div class="gfi-input home-input">
          <input name="password" id="password" type="password" class="gfi-input-text" required/>
          <span class="gfi-input-label">Mot de passe</span>
        </div>

        <div style="text-align: center; vertical-align: middle; padding: 15px 10px;">
          <span style="color: rgba(41, 41, 41, 0.39);">Vous pouvez importer votre CV :</span>
          <div style="vertical-align: middle; margin: 10px 0 -10px; overflow: hidden;" class="align">
            <input type="file" name="cv" id="cv"/>
          </div>
        </div>

        <button id="s1_next" class="btn gfi-btn gfi-btn-primary home-btn full-width">
          <span class="gfi-btn-span firstspan">Suivant</span>
          <span class="gfi-btn-span secondspan">Suivant</span>
        </button>

      </div>

      <!-- Fin step 1 -->

      <!-- Step 2 -->
      <div id="step2" style="margin-top: 25px;">
        <div style="margin: 10px; 0;">
          <span style="display: block; margin-bottom: 10px; color: rgba(41, 41, 41, 0.39);">Qualités</span>
          <select name="qualite1" id="qualite1">
            <?php
            foreach($qualities as $quality) {
              echo "<option id='".$quality['IdSkills']."' value='".$quality['IdSkills']."'>".$quality['Name']."</option>";
            }
            ?>
          </select>

          <select name="qualite2" id="qualite2">
            <?php
            foreach($qualities as $quality) {
              echo "<option id='".$quality['IdSkills']."' value='".$quality['IdSkills']."'>".$quality['Name']."</option>";
            }
            ?>
          </select>
        </div>

        <div style="margin: 10px; 0;">
          <span style="display: block; margin-bottom: 10px; color: rgba(41, 41, 41, 0.39);">Défauts</span>
          <select name="defaut1" id="defaut1">
            <?php
            foreach ($defaults as $default){
              echo "<option id='".$default['IdSkills']."' value='".$default['IdSkills']."'>".$default['Name']."</option>";
            }
            ?>
          </select>
          <select name="defaut2" id="defaut2">
            <?php
            foreach ($defaults as $default){
              echo "<option id='".$default['IdSkills']."' value='".$default['IdSkills']."'>".$default['Name']."</option>";
            }
            ?>
          </select>
        </div>

        <div style="margin: 10px; 0;">
          <span style="display: block; margin-bottom: 10px; color: rgba(41, 41, 41, 0.39);">Compétence</span>
          <select name="competence" id="competence">
            <option value="protection">Protection</option>
            <option value="separation">Séparation</option>
            <option value="enchainement">Enchainement</option>
            <option value="confiance">Confiance</option>
          </select><br/>
        </div>

        <div>
          <div style="padding-left: 0; padding-right: 5px;" class="col-md-6">
            <button id="s2_prev" class="btn gfi-btn gfi-btn-primary home-btn full-width">
              <span class="gfi-btn-span firstspan">Précédent</span>
              <span class="gfi-btn-span secondspan">Précédent</span>
            </button>
          </div>

          <div style="padding-right: 0; padding-left: 5px;" class="col-md-6">
            <button type="submit" form="validerinscription" name="valider" id="validerinscription" value="Valider" class="btn gfi-btn gfi-btn-primary home-btn full-width">
              <span class="gfi-btn-span firstspan">Valider</span>
              <span class="gfi-btn-span secondspan">Valider</span>
            </button>
          </div>
        </div>

      </div>
      <div id="step3" style="margin-top: 25px; text-align: center;">
        <span style="display: block; margin-bottom: 15px; font-weight: 800;">Découvrez votre AVATAR !</span>
        <img style="margin: 10px 0;" src="/src/img/back1.png">
        <button type="submit" name="valider" id="combattre" value="Valider" class="btn gfi-btn gfi-btn-primary home-btn full-width">
          <span class="gfi-btn-span firstspan">Combattre</span>
          <span class="gfi-btn-span secondspan">Combattre</span>
        </button>
      </div>
    </form>

      <!-- Fin step 2 -->

      <!-- Fin formulaire -->

      <div class="gfi-body-footer">
        <a class="home-cgu-link">CGU</a>
        <a class="home-connect-link" style="float: right;">Se connecter</a>
      </div>
    </div>
  </div>
