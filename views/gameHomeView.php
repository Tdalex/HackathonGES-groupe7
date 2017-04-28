<div id="gameindex">
  <div class="col-md-3">
    <img class="home-logo" src="/src/img/home-logo.png" height="250">
    <div style="background: white; border: solid 1px grey; padding: 15px; margin-top: 210px; position: relative;">
      <img style="position: absolute; margin: 0 auto; right: 0; left: 0; top: -201px;" height="200" src="/src/img/back1.png">
      <span style="display: block; font-size: 20px; font-weight: 800; text-align: center;"><?php echo $_SESSION['surname_user'] . ' ' . $_SESSION['name_user']; ?></span>
      <div style="margin: 20px 0;">
        <span>Partie en cours :</span>
        <span style="float: right; padding: 5px 10px; background: #f8b400; color: white;"><?php echo isset($_SESSION['id_game']) ?  'oui' :  'non'; ?></span>
      </div>
      <div style="margin: 20px 0;">
        <span>Parties terminées :</span>
        <span style="float: right; padding: 5px 10px; background: #f8b400; color: white;"><?php echo $_SESSION['game_finished']; ?></span>
      </div>
      <div style="margin: 10px 0;">
        <span>Compétence :</span>
        <button class="btn gfi-btn gfi-btn-second home-btn full-width"  style="margin-top: 10px;">
          <span class="gfi-btn-span firstspan"><?php echo $_SESSION['user_skill']; ?></span>
          <span class="gfi-btn-span secondspan"><?php echo $_SESSION['user_skill']; ?></span>
        </button>
      </div>
    </div>
  </div>
  <div class="col-md-9">
    <div style="background: white; border: solid 1px grey; padding: 15px;position: relative; margin-bottom: 15px;">
      <span style="font-size: 20px; font-weight: 800;">Liste des postes à pourvoir</span>
    </div>

    <!-- postes -->  
	<?php if(isset($_SESSION['id_game'])){ ?>
		<form method='POST' action='/gfiPlay/play'>
			<div style="background: white; border: solid 1px grey; margin-top: 15px;">
			  <div style="height: 150px; width: 150px; float: left;">
				<img src="/src/img/dev.jpg" class="img-cover">
			  </div>
			  <div class="" style="margin: 15px 10px;">
				<span style="margin-left: 5px; background: #292929; color: white;padding: 7px 15px;border-radius: 50px;letter-spacing: 2px; font-weight: 800;"><?php  echo $_SESSION['game_info']['Name']; ?></span>
				<span style="margin-left: 5px; background: orange; color: white;padding: 7px 15px;border-radius: 50px;letter-spacing: 2px;">En cours</span>
				<span style="margin-left: 5px; background: #00a5ff; color: white;padding: 7px 15px;border-radius: 50px;letter-spacing: 2px;"><?php echo $_SESSION['score']; ?> pts</span>
				<span style="float: right;">
				  Postes disponnibles :
				  <span style="padding: 5px 10px; background: #f8b400; color: white;"><?php  echo $_SESSION['game_info']['Quantity']; ?></span>
				</span>
			  </div>
			  <div>
				<span style="margin-left: 10px; display: inline-block;">
				  <?php echo $_SESSION['game_info']['Description'];?>
				</span>
			  </div>
			  <div>
				<button value='<?php echo $_SESSION['id_game']; ?>' type='submit' class="btn gfi-btn gfi-btn-second home-btn full-width no-border posts-link">
				  <span class="gfi-btn-span firstspan">Continuer</span>
				  <span class="gfi-btn-span secondspan">Continuer</span>
				</button>
			  </div>
			</div>
		</form>
	<?php } ?>
	
	<form method='POST' action='/gfiPlay/newGame'>
		<?php foreach($availableJobs as $job){
			if(!(isset($_SESSION['id_job']) && $job['IdJobApplication'] == $_SESSION['id_job'])){?>
			<div style="background: white; border: solid 1px grey; margin-top: 15px;">
			  <div style="height: 150px; width: 150px; float: left;">
				<img src="/src/img/datascientistend.png" class="img-cover">
			  </div>
			  <div class="" style="margin: 15px 10px;">
				<span style="margin-left: 5px; background: #292929; color: white;padding: 7px 15px;border-radius: 50px;letter-spacing: 2px;font-weight: 800;"><?php echo $job['Name']; ?></span>
				<span style="margin-left: 5px; background: green; color: white;padding: 7px 15px;border-radius: 50px;letter-spacing: 2px;">Disponible</span>
				<span style="float: right;">
				  Postes disponibles :
				  <span style="padding: 5px 10px; background: #f8b400; color: white;"><?php echo $job['Quantity']; ?></span>
				</span>
			  </div>
			  <div>
				<span style="margin-left: 10px; display: inline-block;">
						<?php echo $job['Description']; ?>
				</span>
			  </div>	
			  <div>
				<?php if(!isset($_SESSION['id_game'])){ ?>
					<button value='<?php echo $job['IdJobApplication']; ?>' name='job' class="btn gfi-btn gfi-btn-second home-btn full-width no-border posts-link">
					  <span class="gfi-btn-span firstspan">Commencer le jeu</span>
					  <span class="gfi-btn-span secondspan">Commencer le jeu</span>
					</button>
				<?php }else{ ?>
					<button type='button' class="btn gfi-btn gfi-btn-second home-btn full-width no-border posts-link">
						<span class="gfi-btn-span firstspan">Veuillez terminer votre partie avant d'en commencer une autres</span>
						<span class="gfi-btn-span secondspan">Veuillez terminer votre partie avant d'en commencer une autres</span>
					</button>
				<?php } ?>
			  </div>
			</div>
		<?php } }?>
	</form>
	
	<?php if(isset($_SESSION['finished_game'])){
			foreach($_SESSION['finished_game'] as $fg){ ?>
				<div style="background: white; border: solid 1px grey; margin-top: 15px;">
				  <div style="height: 150px; width: 150px; float: left;">
					<img src="/src/img/commercialtel.jpg" class="img-cover">
				  </div>
				  <div class="" style="margin: 15px 10px;">
					<span style="margin-left: 5px; background: #292929; color: white;padding: 7px 15px;border-radius: 50px;letter-spacing: 2px; font-weight: 800;"><?php echo $fg['Name']; ?></span>
					<span style="margin-left: 5px; background: #ea2d2d; color: white;padding: 7px 15px;border-radius: 50px;letter-spacing: 2px;">Terminé</span>
					<span style="margin-left: 5px; background: #00a5ff; color: white;padding: 7px 15px;border-radius: 50px;letter-spacing: 2px;"><?php echo $fg['Score']; ?> pts</span>
					<span style="float: right;">
					  Postes disponnibles :
					  <span style="padding: 5px 10px; background: #f8b400; color: white;"><?php echo $fg['Quantity']; ?></span>
					</span>
				  </div>
				  <div>
					<span style="margin-left: 10px; display: inline-block;">
						<?php echo $fg['Description']; ?>
					</span>
				  </div>
				  <div>
					<button class="btn gfi-btn gfi-btn-second home-btn full-width no-border" style="cursor: not-allowed ;">
					  <span class="gfi-btn-span firstspan">Bloqué jusqu'au 24/05</span>
					  <span class="gfi-btn-span secondspan">Bloqué jusqu'au 24/05</span>
					</button>
				  </div>
				</div>
	<?php } } ?>
    <!-- fin poste -->
  </div>
</div>