<?php

const VIEWS_PATHS = array(

    // ERRORS
    'error_404' => '/Views/errors/error_404.php',


    // MAIN
    'home' => '/Views/user_view/home.php', //a changer ça dépend


    // EVENTS
    'event_add_form' => '/Views/event_view/add_event_view.php',
    'event_calendar_page' => '/Views/event_view/calendar_view.php',
    'event_detail_page' => '/Views/event_view/detail_event_view.php',
    'event_list_page' => '/Views/event_view/list_event_view.php',
    'event_modify_form' => '/Views/event_view/modif_event_view.php',


    // MESSAGERIE
    'messages_page' => '/Views/messagerie_view/messages_list_view.php',


    //OFFERS
    'offers_page' => '/Views/offres_view/offres_view.php',
    'offer_details_page' => '/Views/offres_view/offres_details_view.php',
    'offers_page_recruiter' => '/Views/offres_view/offres_recruiter_view.php',
    'offer_add_form' => '/Views/offres_view/offres_add_view.php',
    'offer_modify_form' => '/Views/offres_view/offres_modify_view.php',


    //SWIPE
    'swipe_page' => '/Views/swipe_view/swipe.php',
    'recruiter_swipe_page' => '/Views/swipe_view/swipe_recruiter.php',
    'explore_users' => '/Views/swipe_view/explore_user.php',
    'swipe_user_page' => '/Views/swipe_view/swipe_user.php',


    // PLAINTES
    'complaint_form' => '/Views/admin_view/complaint_form_view.php',
    'complaint_list_admin' => '/Views/admin_view/complaint_admin_list_view.php',


    //USER
    'edit_profile_form' => '/Views/user_view/edit_profile_view.php',
    'forgot_password_form' => '/Views/user_view/forgot_password_view.php',
    'login_form' => '/Views/user_view/login_view.php',
    'profile_page' => '/Views/user_view/profile_view.php',
    'reset_password_form' => '/Views/user_view/reset_password_view.php',
    'sign_up_form' => '/Views/user_view/signup_view.php',
    'user_profile_page' => '/Views/user_view/user_profile_view.php',

    
    //STATIC
    'terms_page' => '/Views/static/terms.php',
    'about_page' => '/Views/static/about.php',
    'contact_page' => '/Views/static/contact.php',
    'privacy_page' => '/Views/static/privacy.php'
);

const DEFAULT_VIEW_ROUTE = VIEWS_PATHS['error_404'];