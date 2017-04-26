<!DOCTYPE html>
<html>
    <head>
       <!-- <link rel="stylesheet" href="/src/back-css/adminStyle.css" />-->
    </head>
    <body>
        <?php //include 'admin_header.php';?>
        <!-- titre -->
        <div class="container">
            <div class="container">
                <div class="space"></div>
                <div class="row">
                    <div class="menu_header">
                        <div class="col-lg-offset-6 col-lg-3">
                            <a href='/admin/JobApplication'>
                                <i class="glyphicon glyphicon-plus">
                                    <span class="text">gestion des postes à pourvoir</span>
                                </i>
                            </a>
							<a href='/admin/skills'>
                                <i class="glyphicon glyphicon-plus">
                                    <span class="text">gestion des caractères</span>
                                </i>
                            </a>
							<a href='/admin/Questions'>
                                <i class="glyphicon glyphicon-plus">
                                    <span class="text">gestion des questions</span>
                                </i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="logo col_lg-12 col-md-12"><div class="underline"></div></div>
                </div>
            </div>
			
           <!-- Content Section -->
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="pull-right">
							<button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Record</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h3>Candidats:</h3>
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
							<h4 class="modal-title" id="myModalLabel">Add New Record</h4>
						</div>
						<div class="modal-body">

							<div class="form-group">
								<label for="first_name">First Name</label>
								<input type="text" id="first_name" placeholder="First Name" class="form-control"/>
							</div>

							<div class="form-group">
								<label for="last_name">Last Name</label>
								<input type="text" id="last_name" placeholder="Last Name" class="form-control"/>
							</div>

							<div class="form-group">
								<label for="email">Email Address</label>
								<input type="text" id="email" placeholder="Email Address" class="form-control"/>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<button type="button" class="btn btn-primary" onclick="addRecord()">Add Record</button>
						</div>
					</div>
				</div>
			</div>
			<!-- // Modal -->

			<!-- Modal - Update User details -->
			<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Update</h4>
						</div>
						<div class="modal-body">

							<div class="form-group">
								<label for="update_first_name">First Name</label>
								<input type="text" id="update_first_name" placeholder="First Name" class="form-control"/>
							</div>

							<div class="form-group">
								<label for="update_last_name">Last Name</label>
								<input type="text" id="update_last_name" placeholder="Last Name" class="form-control"/>
							</div>

							<div class="form-group">
								<label for="update_email">Email Address</label>
								<input type="text" id="update_email" placeholder="Email Address" class="form-control"/>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Save Changes</button>
							<input type="hidden" id="hidden_user_id">
						</div>
					</div>
				</div>
			</div>
			<!-- // Modal -->


	</body>
</html>