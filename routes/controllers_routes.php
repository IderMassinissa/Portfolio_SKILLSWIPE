<?php

const CONTROLLERS_PATHS = array(

    // // ERRORS
    'error_404' => 'Controllers/errors/error404.php',
    'error_403' => 'Controllers/errors/error403.php',
    'error_401' => 'Controllers/errors/error401.php',

    // EVENTS
    'event' => 'Views/event_view/index.php',
    'event_add' => 'Controllers/event_controller/EventAddController.php',
    'event_calendar' => 'Controllers/event_controller/EventCalendarController.php',
    'event_detail' => 'Controllers/event_controller/EventDetailController.php',
    'event_delete' => 'Controllers/event_controller/EventDeletecontroller.php',
    'event_list' => 'Controllers/event_controller/EventListController.php',
    'event_modify' => 'Controllers/event_controller/Eventmodifcontroller.php',
    'event_participate' => 'Controllers/event_controller/EventParticipationController.php',

    // MESSAGERIE
    'message_add' => 'Controllers/messagerie_controller/message_add_controller.php',
    'message_delete' => 'Controllers/messagerie_controller/message_delete_controller.php',
    'message_modify' => 'Controllers/messagerie_controller/message_modify_controller.php',
    'message_list' => 'Controllers/messagerie_controller/messages_list_controller.php',
    "conversation_delete" => 'Controllers/messagerie_controller/conversation_delete_controller.php',
    'message_check' => 'Controllers/messagerie_controller/check_new_messages.php',

    //OFFERS
    'location_markers_create' => 'Controllers/offres_controller/createLocalisationJson.php',
    'offer_list' => 'Controllers/offres_controller/offres_controller.php',
    'offer_details' => 'Controllers/offres_controller/offres_details_controller.php',
    'offer_location_add' => 'Controllers/offres_controller/offres_localisation_add_controller.php',
    'offer_list_recruiter' => 'Controllers/offres_controller/offres_recruiter_controller.php',
    'search_offer' => 'Controllers/offres_controller/search_offer_controller.php',
    'add_offer' => 'Controllers/offres_controller/offres_add_controller.php',
    'offer_modify' => 'Controllers/offres_controller/offres_modify_controller.php',
    'delete_offer' => 'Controllers/offres_controller/offres_delete_controller.php',


    //SWIPE
    'swipe_api' => 'Controllers/swipe_controller/swipeApiController.php',
    'swipe_page' => 'Controllers/swipe_controller/swipePageController.php',
    'match' => 'Controllers/swipe_controller/matchController.php',
    'explore_users_page' => 'Controllers/swipe_controller/exploreUserPageController.php',
    'swipe_user' => 'Controllers/swipe_controller/swipeUserPageController.php',

    //USER
    'edit_profile' => 'Controllers/user_controller/edit_profile_controller.php',
    'forgot_password' => 'Controllers/user_controller/forgot_password_controller.php',
    'login' => 'Controllers/user_controller/login_controller.php',
    'profile' => 'Controllers/user_controller/profile_controller.php',
    'reset_password' => 'Controllers/user_controller/reset_password_controller.php',
    'sign_up' => 'Controllers/user_controller/signup_controller.php',
    'user_profile' => 'Controllers/user_controller/user_profile_controller.php',
  

    // PLAINTES
    'complaint_admin' => 'Controllers/admin_controller/complaint_admin_controller.php',
    'complaint_send' => 'Controllers/admin_controller/complaint_send_controller.php',
    'complaint_delete' => 'Controllers/admin_controller/complaint_delete_controller.php',



    //API
    'swipe_data' => 'public/api/get_swipe_data.php',
    'swipe_recruiter_data' => 'public/api/get_swipe_recruiter_data.php',
    'leaflet_ban_css' => 'public/api/leaflet-geocoder-ban.js',
    'leaflet_ban_js' => 'public/api/leaflet-geocoder-ban.min.css',
    'match_recruiter' => 'public/api/match_recruiter.php',
    'match_api' => 'public/api/match.php',

    
    //STATIC
    'terms' => 'Controllers/static/terms_controller.php',
    'about' => 'Controllers/static/about_controller.php',
    'contact' => 'Controllers/static/contact_controller.php',
    'privacy' => 'Controllers/static/privacy_controller.php'
);

const DEFAULT_CONTROLLER_ROUTE = CONTROLLERS_PATHS['error_404'];




const DISCONNECTION_CONTROLLER_ROUTE = CONTROLLERS_PATHS['error_401'];