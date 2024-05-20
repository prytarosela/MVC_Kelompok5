<?php

namespace PTMS\MVC\Controller;

class UserController {
  
    public function login() {
      if (isset($_POST['login'])) {
          $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
          $password = md5($_POST['password']);  

          if (empty($username) || empty($password)) {
              echo '<script>alert("Please enter both username and password.")</script>';
              return;
          }

          require_once('../app/config.php');
          $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

          if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
          }

          $stmt = mysqli_prepare($conn, "SELECT ID FROM tbladmin WHERE UserName = ? AND Password = ?");
          mysqli_stmt_bind_param($stmt, "ss", $username, $password);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt, $id);
          mysqli_stmt_fetch($stmt);

          if ($id) {
              // Start session and set session variables
              session_start();
              $_SESSION['ptmsaid'] = $id;
              header("Location: /dashboard");
              // echo "berhasil";
              // include("../app/View/dashboard.php");
              exit();
          } else {
            echo '<script>alert("Please enter both username and password."); window.location.href = "/";</script>';
          }

          mysqli_stmt_close($stmt);
          mysqli_close($conn);
      }
  }

  function logout(): void 
  {
      include("../app/View/logout.php");
  }

  function showProfile(): void 
  {
      include("../app/View/profile.php");
  }

  function settings(): void 
  {
      include("../app/View/change-password.php");
  }

  function updateProfile(): void 
  {
    session_start();
    if (!isset($_SESSION['ptmsaid']) || $_SESSION['ptmsaid'] == 0) {
      header('location:/logout');
      } else {
        if(isset($_POST['submitUpdateProfile']))
        {
          $adminid=$_SESSION['ptmsaid'];
          $aname=$_POST['adminname'];
          $mobno=$_POST['contactnumber'];
        
          include("../app/View/includes/dbconnection.php");
          $query=mysqli_query($con, "update tbladmin set AdminName ='$aname'where ID='$adminid'");
          if ($query) {
            echo '<script>alert("Profile has been updated."); window.location.href = "/profile";</script>';
          }
          else
          {
          
            echo '<script>alert("Something Went Wrong. Please try again."); window.location.href = "/profile";</script>';
          }
        }
      }
  }
  
  function changePassword(): void {
    session_start();
    if (!isset($_SESSION['ptmsaid']) || $_SESSION['ptmsaid'] == 0) {
      header('location:/logout');
    } else{
        if(isset($_POST['submitChangePassword']))
        {
            $adminid=$_SESSION['ptmsaid'];
            $cpassword=md5($_POST['currentpassword']);
            $newpassword=md5($_POST['newpassword']);

            include("../app/View/includes/dbconnection.php");
            $query=mysqli_query($con,"SELECT ID FROM tbladmin WHERE ID='$adminid' AND Password='$cpassword'");
            $row=mysqli_fetch_array($query);
            
            if($row>0){
            $ret=mysqli_query($con, "UPDATE tbladmin SET Password='$newpassword' WHERE ID='$adminid'");
    
            echo '<script>alert("Your password successully changed."); window.location.href = "/settings";</script>';
        } else {
            echo '<script>alert("Your current password is wrong."); window.location.href = "/settings";</script>';
        }
      }
    }
  }
}