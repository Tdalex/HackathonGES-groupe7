<form method="post" action="#" id="form_inscription">
    <input type="hidden" name="type" id="signup" value="signup">
    <div id="step1">
        <label for="name">Nom</label><input name="name" id="name" type="text" required><br/>
        <label for="surname">Prénom</label><input name="surname" id="surname" type="text" required><br/>
        <input type="radio" name="gender" value="0">Homme
        <input type="radio" name="gender" value="1">Femme<br/>
        <label for="birthday">Date de naissance</label><input type="date" name="birthday" id="birthday" required><br/>
        <label for="email">Mail</label><input name="email" id="email" type="email" required><br/>
        <label for="password">Mot de passe</label><input name="password" id="password" type="password" required><br/>
        <label for="cv">CV</label><input type="file" name="cv" id="cv"><br/>
        <button id="s1_next" type="button">Suivant</button>
    </div>
    <div id="step2">
        <h1>Qualités</h1>
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

        <h1>Défauts</h1>
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
        <h1>Compétence</h1>
        <select name="competence" id="competence">
            <option value="protection">Protection</option>
            <option value="separation">Séparation</option>
            <option value="enchainement">Enchainement</option>
            <option value="confiance">Confiance</option>
        </select><br/>
        <button id="s2_prev" type="button">Précédent</button><button id="s2_next" type="button">Suivant</button>
    </div>
    <div id="step3">
        <!-- Avatar -->
        <input type="submit" name="valider" id="valider" value="Valider">
        <button id="s3_prev" type="button">Précédent</button>
    </div>

</form>
