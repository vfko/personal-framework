<?php

/**
 * Includer of classes
*/


// Config
include 'config/constants.php';

// Router
include 'library/built-in/Router.php';

// Application
include 'library/built-in/App.php';

// Database
include 'library/built-in/MysqliDb.php';

// Parent Controller
include 'library/built-in/Controller.php';

// Parent Model
include 'library/built-in/Model.php';

// Authenticate
include 'library/built-in/Authenticate.php';

// Flash message
include 'library/built-in/FlashMessage.php';

// PHPMailer
include 'library/PHPMailer/src/Exception.php';
include 'library/PHPMailer/src/SMTP.php';
include 'library/PHPMailer/src/PHPMailer.php';
include 'library/Mailer.php';

// App homepage
include 'app/homepage/controllers/HomepageController.php';
include 'app/homepage/models/HomepageModel.php';

// App error-page
include 'app/error-page/controllers/ErrorPageController.php';