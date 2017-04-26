<!DOCTYPE html>
<html>
    <head>
       <!-- <link rel="stylesheet" href="/src/back-css/adminStyle.css" />-->
    </head>
    <body>
        <?php //include 'admin_header.php';?>
        <!-- titre -->
        <div data-type=<?php echo $type; ?> class="CRUD container">
            <div class="container">
                <div class="space"></div>
                <div class="row">
                    <div class="menu_header">
                        <div class="col-lg-offset-6 col-lg-3">
                            <form method='POST' action=''>
								<?php foreach($links as $link){ ?>
									<button value='<?php echo $link; ?>' name='type' type='submit'>Gestion des <?php echo $link; ?></button>
								<?php } ?>
							</form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="logo col_lg-12 col-md-12"><div class="underline"></div></div>
                </div>
            </div>
			
           <!-- Content Section -->
			<div class="container">
				<?php if ($type != 'Candidats'){ ?>
					<div class="row">
						<div class="col-md-12">
							<div class="pull-right">
								<button class=" btn btn-success" data-type='<?php echo $type; ?>' data-toggle="modal" data-target="#add_new_record_modal">Ajout de <?php echo $type; ?></button>
							</div>
						</div>
					</div>
				<?php } ?>
				<div class="row">
					<div class="col-md-12">
						<h3><?php echo $type; ?>:</h3>
						<div class="records_content"></div>
					</div>
				</div>
			</div>
			<!-- /Content Section -->


			<!-- Bootstrap Modals -->
			<!-- Modal - Add New Record/User -->
			<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Ajout de <?php echo $type; ?></h4>
						</div>
						<div class="modal-body">
							<?php include('modal/add'.$type.'.php'); ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Retour</button>
							<button type="button" data-type='<?php echo $type; ?>' class="addRecord btn btn-primary">Confirmer</button>
						</div>
					</div>
				</div>
			</div>
			<!-- // Modal -->

			<!-- Modal - Update User details -->
			<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content ">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"><?php echo $type; ?></h4>
						</div>
						<div class="modal-body detail_content">	
							<?php include('modal/add'.$type.'.php'); ?>						
						</div>
						<div class="modal-footer">
						</div>
					</div>
				</div>
			</div>
			<!-- // Modal -->


	</body>
</html>