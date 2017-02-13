<?php
session_start();
require('function.php');
require('connection.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Recommendation Service</title>

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
	<div>
	<img src="../images/header4.png" class="col-lg-12 col-xs-12"></image>
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	</div>
	<!--<a class="navbar-brand" href="index.php">BPS Social Media</a>-->
</div>
<!-- /.navbar-header -->
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1" style="margin-top:-200px;">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
					Metode:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a class="dropdown-toggle" href="index.php">
                        PVW-A
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a class="dropdown-toggle" href="pv_btf.php">
                        PVW-B
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a class="dropdown-toggle" href="pv.php">
                        PV
                    </a>
					<ul class="nav navbar-top-links navbar-right" ><font size="3px"><i>Metode PVW-B</i></font></ul>
                    </div>
                    <div class="panel-body">
                        <form role="form" name="loginForm" method="post" action="">
                            <fieldset>
                                <div class="form-group">
                                    <!--<input class="form-control" width = "300px" name="searchtext" type="text">-->
									<textarea name="searchtext" class="form-control input-sm" style="height: 70px;"></textarea>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
								<div class="col-md-4 col-md-offset-4">
									<input name="search" type="submit" class="btn btn-lg btn-success btn-block">
									
									<!--<textarea name="textarea" class="form-control input-sm" style="width: 480px; height: 80px; margin-top: 10px;" placeholder="Share your thought here..." ></textarea>-->
								</div>
                            </fieldset>
                        </form>
                    </div>
					<div class="panel-body">
					<?php
					if(isset($_POST['search'])){
						$q = $_POST['searchtext'];
						if ($q != ""){
							$message = '<strong>Query: "'.$q.'"</strong><br><hr>';
							// Execute the python script with the JSON data
							$command = print_r(shell_exec("pvsim_btf.py $q"),true);
							$rows = json_decode($command,true);
							
							$data = $rows['row'];
							if ($data !=NULL){
								foreach ($data as $key => $row){
									$similarity[$key]=$row['similarity'];
								}
								array_multisort($similarity,SORT_DESC,$data);
							}
						}
						else{
							$message = "";
						}
					?>
						<div>
							<?php echo $message;?>
						</div>
					<?php
						if ($data==NULL){
							echo "No result found";
						}
						else{
							for($i=0;$i<count($data);$i++){
								if($data[$i]['similarity']!='100'){
						?>
								<div class="chat-body clearfix">
									<div>
										<?php 								
											echo $i;
											echo $data[$i]['data'];
										?>
									</div>
									<span class="pull-right">
										<i><?php //echo "<progress value=".$data[$i]['similarity']." max='100'></progress>";?></i><br><br>
									</span>
								</div>
						<?php
								}
							}
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
