<?php
require_once "routes/controllers_routes.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$action = $_GET['action'] ?? 'index';

switch($action) {
    
    case 'add':
        require_once CONTROLLERS_PATHS['event_add'];
        $controller = new EventAddController();
        $controller->addForm();
        break;

    case 'delete':
        require_once CONTROLLERS_PATHS['event_delete']; 
        $controller = new EventDeleteController();
        $controller->deleteevent();
        break;

    case 'store':
        require_once CONTROLLERS_PATHS['event_add'];
        $controller = new EventAddController();
        $controller->store();
        break;

    case 'details':
        require_once CONTROLLERS_PATHS['event_detail'];
        $controller = new EventDetailController();
        $controller->show();
        break;

    case 'calendar':
        require_once CONTROLLERS_PATHS['event_calendar'];
        $controller = new EventCalendarController();
        $controller->calendar();
        break;

    case 'participate':
        require_once CONTROLLERS_PATHS['event_participate'];
        $controller = new EventParticipationController();
        $controller->participate();
        break;

    case 'edit':
        require_once CONTROLLERS_PATHS['event_modify'];
        $controller = new EventEditController();
        $controller->editForm($_GET['id'] ?? null);
        break;

    case 'update':
        require_once CONTROLLERS_PATHS['event_modify'];
        $controller = new EventEditController();
        $controller->update($_GET['id'] ?? null);
        break;
    
    case 'index':
        require_once CONTROLLERS_PATHS['event_list'];
        $controller = new EventListController();
        $controller->index();
        break;

    default:
}
