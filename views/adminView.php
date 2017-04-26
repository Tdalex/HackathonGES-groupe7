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
							<?php if ($type == 'Questions'){?>
								<button class=" btn btn-success" data-type='<?php echo $type; ?>' data-toggle="modal" data-target="#add_new_opened_question">Ajout d'une question ouverte</button>
								<button class=" btn btn-success" data-type='<?php echo $type; ?>' data-toggle="modal" data-target="#add_new_closed_question">Ajout d'une question fermée</button>
								<!-- question ouverte -->
								<div class="modal fade" id="add_new_opened_question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div id="open_form" class="modal-content ">
											<div class="modal-body detail_content">	
												<div class="form-group">
													<label for="wording">Enonce</label>
													<textarea id="wording" placeholder="Enonce" class="form-control"></textarea>
												</div>

												<div class="form-group">
													<label for="job">Poste</label></br>
													<select id='job'>
													<?php
														foreach($availableJobs as $job) {
															echo "<option id='job-".$job['IdJobApplication']."' value='".$job['IdJobApplication']."'>".$job['Name']."</option>";
														}
													?>
													</select>
												</div>
												<div class="form-group">
													<label for="answer">Reponse</label>
													<input type="text" id="answer" placeholder="Reponse" class="form-control"/>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Retour</button>
												<button type="button" data-type='<?php echo $type; ?>' class="addRecordOpen btn btn-primary">Confirmer</button>
											</div>
										</div>
									</div>
								</div>
								<!-- // Modal -->

								<!-- question QCM -->
								<div class="modal fade" id="add_new_closed_question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content ">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel"><?php echo $type; ?></h4>
											</div>
											<div id="QCM_form" class="modal-body detail_content">	
												<div class="form-group">
													<label for="wording">Enonce</label>
													<textarea id="wording" placeholder="Enonce" class="form-control"></textarea>
												</div>

												<div class="form-group">
													<label for="job">Poste</label>
													<select id='job'></br>
													<?php
														foreach($availableJobs as $job) {
															echo "<option id='job-".$job['IdJobApplication']."' value='".$job['IdJobApplication']."'>".$job['Name']."</option>";
														}
													?>
													</select>
												</div>
												<div id='anwser1'>
													<label >Reponse 1</label>
													<div class="form-group">
														<label for="text_answer">texte</label>
														<input type="text_answer" id="text_answer" placeholder="texte" class="text_answer form-control">
													</div>

													<div class="form-group">
														<label for="is_answer">reponse juste ?</label>
														<input type="checkbox" class="is_answer" value="1"/>
													</div>
												</div>
												<div id='anwser2'>
													<label >Reponse 2</label>
													<div class="form-group">
														<label for="text_answer">texte</label>
														<input type="text_answer" placeholder="texte" class="text_answer form-control"/>
													</div>

													<div class="form-group">
														<label for="is_answer">reponse juste ?</label>
														<input type="checkbox" class="is_answer" value="2" />
													</div>
												</div>
												<div id='anwser3'>
													<label >Reponse 3</label>
													<div class="form-group">
														<label for="text_answer">texte</label>
														<input type="text_answer" placeholder="texte" class="text_answer form-control"/>
													</div>

													<div class="form-group">
														<label for="is_answer">reponse juste ?</label>
														<input type="checkbox" class="is_answer" value="3"/>
													</div>
												</div>
												<div id='anwser4'>
													<label >Reponse 4</label>
													<div class="form-group">
														<label for="text_answer">texte</label>
														<input type="text_answer" placeholder="texte" class="text_answer form-control"/>
													</div>

													<div class="form-group">
														<label for="is_answer">reponse juste ?</label>
														<input type="checkbox" class="is_answer" value="4" />
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Retour</button>
												<button type="button" data-type='<?php echo $type; ?>' class="addRecordQCM btn btn-primary">Confirmer</button>
											</div>
										</div>
									</div>
								</div>
								<!-- // Modal -->							
							<?php }else{ ?>
								<button class=" btn btn-success" data-type='<?php echo $type; ?>' data-toggle="modal" data-target="#add_new_record_modal">Ajout de <?php echo $type; ?></button>
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
							<?php } ?>						
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
	</body>
</html>