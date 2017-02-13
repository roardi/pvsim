
<?php
	include("connection.php");
	function loginme(){
		if(isset($_POST['login'])){
		
			$studentid = $_POST['studid'];	
			$pass = $_POST['password'];
			
			$query2 = mysqli_query($con,"SELECT * FROM members WHERE student_id = '$studentid' AND Password = '$pass' ") or die (mysqli_error());
				$numberOfRows = mysqli_NUMROWS($query2);
				if ($numberOfRows == 0)
					{
						echo "wewewewewew";
					}
				else if ($numberOfRows > 0){
						$wewness = mysqli_query($con,"SELECT * FROM members WHERE student_id = $studentid")or die(mysqli_error());
						$getid = mysqli_fetch_array($wewness);
						$_SESSION['login'] = 'true';
						$_SESSION['member_id'] = $getid['memberid'];
						$_SESSION['studentid'] = $student_id;
					}
				}
			}
	function showallpostprof(){
		$member_id = $_SESSION['member_id'];
		$post = mysqli_query($con,"SELECT * FROM posts WHERE post_to = '$member_id'")or die(mysqli_error());
		while($row = mysqli_fetch_array($post)){
		echo "<div class = 'postcon'><hr /><br />".$row['member_id']."<br /><br />
		".$row['actualpost']."<br /><hr />
		</div>";
		}
	}
	function getinfo(){
		$member_id = $_SESSION['member_id'];
		$post = mysqli_query($con, "SELECT * FROM members WHERE member_id = '$member_id'")or die(mysqli_error());
		$row = mysqli_fetch_array($post);
		echo "<img src='image/members/".$post['photo']."width='50px' height='50px''>";
		echo $post['member_id'];
		}
		
	function searchmembers($search_term){

			$sql = mysqli_query($con,"SELECT * FROM `members` WHERE `firstname` LIKE '%$search_term%' OR `lastname` LIKE '%$search_term%' LIMIT 0, 30 ") or die (mysqli_error());
		            $num_of_row   = mysqli_num_rows($sql);
			    if ($num_of_row > 0 ){
					 while($row    = mysqli_fetch_array($sql))
					{ 
						$id = $row['member_id'];
						echo "<img src='image/members/".$row['photo']."' width='50' height='50' style='margin-right:4px;'>";
						echo "</span><div class='clr2'></div>";
						echo "<a href='profilefriends.php?action=view&id=".$id."' style='color:blue; text-decoration:none;'>". $row['firstname']."&nbsp;".$row['lastname']."</a>";
						echo "<p>"."<a href='addfriend.php?action=view&id=".$id."' style='color:blue; text-decoration:none;'rel = 'facebox' >Add as School Friend</a>"."</p>";
						
					}
				}
				else
				{
			
				  echo "<font color='red' size='4' >No result found!</font>";
				}
	
				
				

}	

						
					
				
				



function uploadedphoto(){

$id = $_SESSION['member_id'];
$query = mysqli_query($con,"SELECT * FROM upload WHERE member_id = '$id'")or die(mysqli_error());
		$row_result = mysqli_num_rows($query);
		
	   if($row_result > 0){
		$msg = '<div>';
		while($row = mysqli_fetch_array($query)){
		
			$fname = $row['file_name'];
			
				$msg .= '<span style="float:left;padding:10px;"><img src="images/upload/'. $fname .'" width="100" height="100"/></span>';
				
		
			}

			 $msg .= '</div>'; 
			 echo $msg;
			
			;
		
		}else{
			echo '<div style="margin:10px">No Photos Uploaded</div>';
			
		}
}

function seealloffers(){
		
		


}


?>