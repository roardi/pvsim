<?php
header('application-type: application/json');

include("connection.php");
include("function.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PV-Sim</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div class="navbar-header">
	<img src="../images/header_bps.png" class="col-xs-12" width="100%"></image>
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
</div>
<!-- /.navbar-header -->
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                
                    <div class="panel-heading">
                        <h3 class="panel-title"></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" name="search" method="post" action="">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" width = "300px" placeholder="Search" name="searchtext" type="text">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
								<div>
									<input name="search" type="submit" class="btn btn-lg btn-success btn-block text-center">
								</div>
                            </fieldset>
                        </form>
                    </div>
					<div class="panel-body">
						<?php
						if(isset($_POST['search'])){
							$q = $_POST['searchtext'];
							
							// Execute the python script with the JSON data
							$command = print_r(shell_exec("C:\xampp\htdocs\PVSim-Py\pvsim_atf.py $q"),true);
							$rows = json_decode($command,true);
							
							$data = $rows['row'];
							if ($data !=NULL){
								foreach ($data as $key => $row){
									$similarity[$key]=$row['similarity'];
								}
								array_multisort($similarity,SORT_DESC,$data);
							}
						?>
							<div>
								<?php echo '<strong>Query: "'.$q;echo '"</strong><br><hr>';?>
							</div>
						<?php	
							for($i=0;$i<count($data);$i++){
						?>
								<div class="chat-body clearfix">
									<div>
										<?php echo $data[$i]['data'];?>
									</div>
									<span class="pull-right">
										<i><?php echo "Similarity: ".$data[$i]['similarity']." %  "."<progress value=".$data[$i]['similarity']." max='100'></progress>";?></i><br><br>
									</span>
								</div>
						<?php
							}
						}
						?>
                        </div>
                        <!-- /.panel-body -->
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>