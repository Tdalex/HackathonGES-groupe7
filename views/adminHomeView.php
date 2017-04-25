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
                                    <span class="text">gestion des jobs</span>
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
                <div class="filters">
                    <h3>Candidats: </h3>
                    <form method='POST'>
						<!-- filter -->
                        <div class="search">
                        </div>
                    </form>
                </div>
            </div>
            <!-- Candidates -->
            <div id="Candidates">
                <div class="container">
                    <?php  if(!empty($candidate)){ ?>
                        <div class="row">
							<?php
							// view candidates
							foreach($candidate as $c){ ?>
							<div class="col-sm-4">
								<div class="thumbnail">
									<a href="<?php echo '/admin/candidate/'.$c['Id_candidate'] ?>">
										<div class="caption">
											<h3><?php echo $c['Surname'] . ' ' . $c['Name'] ?></h3>
											<p><?php echo $c['JobApplication'] ?></p>
										</div>
									</a>
								</div>
							</div>
							</a>
							<?php } ?>
                        </div>
                    <?php }else{ ?>
                        <div style="text-align: center"><h3>Aucun candidat ne correspond a votre recherche</h3></div>
                    <?php } ?>
                </div>
            </div>
            <div class=container">
                <div class="row">
                    <div class="col-lg-offset-4 col-lg-4">
                        <form method='post' class="center_form">
							<?php foreach($filter as $name => $value){
								echo "<input name='". $name ."' value='". $value ."' checked style='display: none' type='checkbox'></input>";
							}?>
                            <ul class="pagination">
                                <?php
                                //pagination
                                $p = 0;
                                while($p < $maxPage){
                                    $p++;
                                    if($p != $page){
                                        echo '<li><input name="page" class="submit" type="submit" value=' .$p .'></input></li>' ;
                                    }else{
                                        echo '<li class="disabled"><input id="disabled" class="submit" type="submit" value=' .$p .'></input></li>' ;
                                    }
                                }
                                ?>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>


	</body>
</html>