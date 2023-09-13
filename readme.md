For PHP 7.4 or higher

########
# Apps #
########

    - every page is stored as app in app/
    - every page name is the same as app
    Example:
      - page: About us
      - folder: app/about-us/

# Name of app in URL
    - app name has same name as first URL parameter
    Example:
        - URL: www.example.com/app-name/parameter
        - folder: app/app-name/



###############
# Controllers #
###############

    - it is important to follow the controller location and name format
    Example:
        - URL: www.example.com/app-name/parameter
        - controller: app/app-name/controllers/AppNameController.php  

# $controller_parameters
    - array of URL parameters (except the first -> app-name) is passed to app controller => $controller_parameters


#############
# Templates #
#############

    - path to template has same names of folders as url parameters
    - to browser is included template with strict name "AppNameTemplate.php"
    Example1:
      - URL: www.example.com/app-name
      - path: app/app-name/templates/AppNameTemplate.php
    Example2:
      - URL: www.example.com/app-name/parameter1/parameter2
      - path: app/app-name/templates/parameter1/parameter2/Parameter2Template.php


##########
# Models #
##########

    - models are stored in app/app-name/models
    - name of models are not strict
    - Model.php contain base database query


##############
# Dependenci #
##############

    - every external library is stored in library/
    - this library must be included in config/loader.php
    - if library-1 has dependenci on library-2, library-2 must be included begore library-1


################
# Page builder #
################

    - main classes are stored in library/built-in
    - there is page builder like Router.php and Application.php
      and other main classes from which other inherit like Controller.php, Model.php and MysqliDb.php

# App.php
    - this class is called in index.php
    - it create controller instance and create page

# Router.php
    - helper class for Application.php

# Controller.php
    - main controller contains


##########
# Config #
##########

    - configuration files are stored in config/

# constants.php
    - there is global constants like DB login

# loader.php
    - contains all classes
    - it replaces autoloader
    - each newly created class must be typed into loader.php