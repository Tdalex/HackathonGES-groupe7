<!DOCTYPE html>
<html>
    <head>
    </head>
    <body> 
	
		<?php if(isset($_SESSION['id_game']) && !empty($_SESSION['id_game'])){ ?>
			<form method='POST' action='/gfiPlay/play'>
				<button type='submit'>Continuer la partie precedente</button>
			</form>
		<?php }else{ ?>
			<form method='POST' action='/gfiPlay/newGame'>
			<?php foreach($availableJobs as $job){ ?>
				<button value='<?php echo $job['IdJobApplication']; ?>' name='job' type='submit'><?php echo $job['Quantity'] .' poste(s) libre(s)  pour ' . $job['Name']; ?></button>
			<?php } ?>
			</form>
		<?php } ?>
	</body>
</html>