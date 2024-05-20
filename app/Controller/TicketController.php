<?php

namespace PTMS\MVC\Controller;

class TicketController {
    function manageTicket(): void 
    {
        include("../app/View/manage-ticket.php");
    }
    function addNormalTicket(): void 
    {
        include("../app/View/add-normal-ticket.php");
    }

    function saveNormalTicket(): void 
    {
        session_start();
        if (!isset($_SESSION['ptmsaid']) || $_SESSION['ptmsaid'] == 0) {
            header('location:/logout');
        } else {
            if(isset($_POST['submitNormalTicket']))
            {
                $noadult=$_POST['noadult'];
                $nochildren=$_POST['nochildren'];
                $aprice=$_POST['aprice'];
                $cprice=$_POST['cprice'];
                $ticketid=mt_rand(100000000, 999999999);
            
                require_once('../app/config.php');
                $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $query=mysqli_query($conn, "insert into  tblticindian(TicketID,NoAdult,NoChildren,AdultUnitprice,ChildUnitprice) value('$ticketid','$noadult','$nochildren','$aprice','$cprice')");
                if ($query) {
                    echo '<script>alert("Ticket information has been added."); window.location.href = "/addNormalTicket";</script>';
                }
                else
                {
                echo '<script>alert("Something Went Wrong. Please try again."); window.location.href = "/addNormalTicket";</script>';
                }
            }
        }
    }

    function manageNormalTicket(): void 
    {
        include("../app/View/manage-normal-ticket.php");
    }

    public function viewNormalTicketDetail() {
        session_start();
        $ticketId = $_GET['viewid'];
        if (!isset($_SESSION['ptmsaid']) || $_SESSION['ptmsaid'] == 0) {
            header('location:/logout');
            exit();
        }
        
        include("../app/View/includes/dbconnection.php");
        $query = "SELECT * FROM tblticindian WHERE ID='$ticketId'";
        $result = mysqli_query($con, $query);

        if ($row = mysqli_fetch_array($result)) {
            $ticketDetail = $row;
        } else {
            $ticketDetail = [];
        }

        include('../app/View/view-normal-ticket.php');
    }

    function addForeignersTicket(): void 
    {
        include("../app/View/add-foreigners-ticket.php");
    }

    function saveForeignersTicket(): void
    {
        session_start();
        if (!isset($_SESSION['ptmsaid']) || $_SESSION['ptmsaid'] == 0) {
            header('location:/logout');
        } else{
            if(isset($_POST['submitForeignersTicket']))
            {
                $noadult=$_POST['noadult'];
                $nochildren=$_POST['nochildren'];
                $aprice=$_POST['aprice'];
                $cprice=$_POST['cprice'];
                $ticketid=mt_rand(100000000, 999999999);
                
                require_once('../app/config.php');
                $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $query=mysqli_query($conn, "insert into tblticforeigner(TicketID,NoAdult,NoChildren,AdultUnitprice,ChildUnitprice) value('$ticketid','$noadult','$nochildren','$aprice','$cprice')");
                
                if ($query) {
                    echo '<script>alert("Ticket information has been added."); window.location.href = "/addForeignersTicket";</script>';
                }
                else
                {
                    echo '<script>alert("Something Went Wrong. Please try again."); window.location.href = "/addForeignersTicket";</script>';
                }
            }
        }
    }

    function manageForeignersTicket(): void 
    {
        include("../app/View/manage-foreigners-ticket.php");
    }

    public function viewForeignersTicketDetail() {
        session_start();
        $ticketId = $_GET['viewid'];
        if (!isset($_SESSION['ptmsaid']) || $_SESSION['ptmsaid'] == 0) {
            header('location:/logout');
            exit();
        }
        
        include("../app/View/includes/dbconnection.php");
        $query = "SELECT * FROM tblticforeigner WHERE ID='$ticketId'";
        $result = mysqli_query($con, $query);

        if ($row = mysqli_fetch_array($result)) {
            $ticketDetail = $row;
        } else {
            $ticketDetail = [];
        }

        include('../app/View/view-foreigner-ticket.php');
    }

    function normalSearch(): void 
    {
        session_start();
        include("../app/View/normal-search.php");
    }

    public function searchNormalTicketData() {
        session_start();
        if (!isset($_SESSION['ptmsaid']) || $_SESSION['ptmsaid'] == 0) {
            header('location:/logout');
            exit();
        }

        if(isset($_POST['submitSearchNormalTicketData']))
        {
            $sdata = $_POST['searchdata'];
            include("../app/View/includes/dbconnection.php");
            $query = "SELECT * FROM tblticindian WHERE TicketID LIKE '$sdata%'";
            $ret = mysqli_query($con, $query);

            $dataRetrivied = ['ret' => $ret];
            extract($dataRetrivied);
            include('../app/View/normal-search.php');
        }

        include('../app/View/normal-search.php');
    }

    function foreignerSearch(): void 
    {
        session_start();
        include("../app/View/foreigner-search.php");
    }

    public function searchForeignerTicketData() 
    {
        session_start();
        if (!isset($_SESSION['ptmsaid']) || $_SESSION['ptmsaid'] == 0) {
            header('location:/logout');
            exit();
        }

        if(isset($_POST['submitSearchForeignerTicketData']))
        {
            $sdata = $_POST['searchdata'];
            include("../app/View/includes/dbconnection.php");
            $query = "SELECT * FROM tblticforeigner WHERE TicketID LIKE '$sdata%'";
            $ret = mysqli_query($con, $query);

            $dataRetrivied = ['ret' => $ret];
            extract($dataRetrivied);
            echo "AAAAA";
            include('../app/View/foreigner-search.php');
        }

        include('../app/View/foreigner-search.php');
    }

    function editTicketCost(): void {
        session_start();
        if (!isset($_SESSION['ptmsaid']) || $_SESSION['ptmsaid'] == 0) {
            header('location:/logout');
            exit();
        } else{
            if(isset($_POST['submitEditTicketCost']))
            {
                $tid=$_POST['ticketid'];
                $tpype=$_POST['tickettype'];
                $tprice=$_POST['tprice'];
                
                include("../app/View/includes/dbconnection.php");
                $query=mysqli_query($con, "UPDATE tbltickettype SET TicketType='$tpype',Price='$tprice' WHERE ID='$tid'");
                if ($query) {
                    echo '<script>alert("Ticket detail has been updated."); window.location.href = "/manageTicket";</script>';
                }
                else
                {
                    echo '<script>alert("Something Went Wrong. Please try again."); window.location.href = "/manageTicket";</script>';
                }
            }
        }
    }

    public function editTicketPage() {
        session_start();
        $ticketId = $_GET['editid'];
        if (!isset($_SESSION['ptmsaid']) || $_SESSION['ptmsaid'] == 0) {
            header('location:/logout');
            exit();
        }
        
        include("../app/View/includes/dbconnection.php");
        $query = "SELECT * FROM tbltickettype where ID='$ticketId'";
        $ret = mysqli_query($con, $query);

        $dataRetrieved = ['ret' => $ret];
        extract($dataRetrieved);

        include('../app/View/edit-ticket.php');
    }
}