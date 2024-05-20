<?php

// $path = '/';

// if(isset ($_SERVER['PATH_INFO'])){
//     $path = $_SERVER ['PATH_INFO'];
// }

// require __DIR__ . '/../app/View' . $path . '.php';

require_once __DIR__ . '/../vendor/autoload.php';

use PTMS\MVC\App\Router;
use PTMS\MVC\Controller\UserController;
use PTMS\MVC\Controller\TicketController;
use PTMS\MVC\Controller\PageController;
use PTMS\MVC\Controller\ReportController;

Router::add('GET', '/', PageController::class, 'index');
Router::add('GET', '/dashboard', PageController::class, 'showDashboard');

Router::add('POST', '/login', UserController::class, 'login');
Router::add('GET', '/profile', UserController::class, 'showProfile');
Router::add('POST', '/updateProfile', UserController::class, 'updateProfile');
Router::add('POST', '/changePassword', UserController::class, 'changePassword');
Router::add('GET', '/settings', UserController::class, 'settings');
Router::add('GET', '/logout', UserController::class, 'logout');

Router::add('GET', '/manageTicket', TicketController::class, 'manageTicket');
Router::add('GET', '/addNormalTicket', TicketController::class, 'addNormalTicket');
Router::add('GET', '/manageNormalTicket', TicketController::class, 'manageNormalTicket');
Router::add('GET', '/addForeignersTicket', TicketController::class, 'addForeignersTicket');
Router::add('GET', '/manageForeignersTicket', TicketController::class, 'manageForeignersTicket');
Router::add('GET', '/viewNormalTicketDetail', TicketController::class, 'viewNormalTicketDetail');
Router::add('GET', '/viewForeignersTicketDetail', TicketController::class, 'viewForeignersTicketDetail');
Router::add('GET', '/editTicketPage', TicketController::class, 'editTicketPage');

Router::add('POST', '/saveNormalTicket', TicketController::class, 'saveNormalTicket');
Router::add('POST', '/saveForeignersTicket', TicketController::class, 'saveForeignersTicket');
Router::add('POST', '/editTicketCost', TicketController::class, 'editTicketCost');

Router::add('GET', '/normalSearch', TicketController::class, 'normalSearch');
Router::add('GET', '/foreignerSearch', TicketController::class, 'foreignerSearch');

Router::add('POST', '/searchNormalTicketData', TicketController::class, 'searchNormalTicketData');
Router::add('POST', '/searchForeignerTicketData', TicketController::class, 'searchForeignerTicketData');

Router::add('GET', '/normalPeopleReport', ReportController::class, 'normalPeopleReport');
Router::add('GET', '/foreignerPeopleReport', ReportController::class, 'foreignerPeopleReport');

Router::add('POST', '/viewNormalReport', ReportController::class, 'viewNormalReport');
Router::add('POST', '/viewForeignerReport', ReportController::class, 'viewForeignerReport');

Router::run();