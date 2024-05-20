<?php

namespace PTMS\MVC\Controller;

class ReportController {
    function normalPeopleReport(): void 
    {
        include("../app/View/between-dates-normalreports.php");
    }

    public function viewNormalReport() 
    {
        session_start();
        if (!isset($_SESSION['ptmsaid']) || $_SESSION['ptmsaid'] == 0) {
            header('location:/logout');
            exit();
        }

        if(isset($_POST['submitViewNormalReport']))
        {
            $fdate=$_POST['fromdate'];
            $tdate=$_POST['todate'];

            include("../app/View/includes/dbconnection.php");
            $query = "SELECT * FROM tblticindian WHERE DATE(PostingDate) BETWEEN '$fdate' AND '$tdate'";
            $ret = mysqli_query($con, $query);

            $dataRetrieved = ['ret' => $ret, 'fdate' => $fdate, 'tdate' => $tdate];
            extract($dataRetrieved);
            include('../app/View/normal-bwdates-reports-details.php');
        }

        include('../app/View/normal-bwdates-reports-details.php');
    }

    function foreignerPeopleReport(): void 
    {
        include("../app/View/between-dates-foreignerreports.php");
    }

    public function viewForeignerReport() 
    {
        session_start();
        if (!isset($_SESSION['ptmsaid']) || $_SESSION['ptmsaid'] == 0) {
            header('location:/logout');
            exit();
        }

        if(isset($_POST['submitViewForeignerReport']))
        {
            $fdate=$_POST['fromdate'];
            $tdate=$_POST['todate'];

            include("../app/View/includes/dbconnection.php");
            $query = "SELECT * FROM tblticforeigner WHERE DATE(PostingDate) BETWEEN '$fdate' AND '$tdate'";
            $ret = mysqli_query($con, $query);

            $dataRetrieved = ['ret' => $ret, 'fdate' => $fdate, 'tdate' => $tdate];
            extract($dataRetrieved);
            include('../app/View/foreigner-bwdates-reports-details.php');
        }

        include('../app/View/foreigner-bwdates-reports-details.php');
    }
}