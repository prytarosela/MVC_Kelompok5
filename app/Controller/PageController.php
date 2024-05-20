<?php

namespace PTMS\MVC\Controller;

class PageController {

    function index(): void 
    {
        include("../app/View/index.php");
    }
    
    function showDashboard(): void 
    {
        include("../app/View/dashboard.php");
    }
}