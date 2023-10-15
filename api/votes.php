<?php
session_start();
include('connect.php');

$votes= $_POST['gvotes'];
$total_votes =$votes+1;
$gid=$_POST['gid'];
$uid=$_SESSION['userdata']['id'];

$update=mysqli_query($connect,"UPDATE userr SET votes='$total_votes' WHERE id='$gid'");
$update_user_status=mysqli_query($connect,"UPDATE userr SET status=1 WHERE id='$uid'");
if($update and $update_user_status)
{
    $groups=mysqli_query($connect,"SELECT id,name,votes,photo FROM userr WHERE role=2");
    $groupsdata=mysqli_fetch_all($groups, MYSQLI_ASSOC);

    $_SESSION['userdata']['status']=1;
    $_SESSION['groupsdata']=$groupsdata;
    echo'
    <script>
    alert("Voting succesfully!");
    window.location="../front/dashboardd.php";
    </script>
  ';
}
else{
    echo'
    <script>
    alert("Some error occured!");
    window.location="../front/dashboardd.php";
    </script>
  ';
}
?>