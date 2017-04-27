<!DOCTYPE html>
<html>
    <head>
    </head>
    <body> 
		<form method='POST' action='/gfiPlay/newGame'>
		<?php foreach($availableJobs as $job){ ?>
			<button value='<?php echo $job['IdJobApplication']; ?>' name='type' type='submit'><?php echo $job['Quantity'] .' poste(s) libre(s)  pour ' . $job['Name']; ?></button>
		<?php } ?>
		</form>
	</body>
</html>