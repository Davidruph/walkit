/**
 * Walkit Tally
 *
 * @package  Core PHP
 * @author   tfelsky 
 * @co-author   David Junior -> https://www.fiverr.com/davidjunior195
 *
 */
## Walkit Walking Tally Project

## Benefit of the Project

-   To encourage more environmentally conscious behavior walking instead of driving.


## Features of the Projects

-   Authentication systems for admin.
    admin login system with email, password and google recaptcha v3 to prevent spam and bots from auto login.

-   Google Mapping API including geocoding, Directions, map javascript library
    this plugin is provided by google to calculate distance in kms, get distance from a companies business address to user home address, displays this disatnce in a map embedded on the page to show the time to walk there, the maps is set to start from united kingdon, and also auto-populate the address input.

-   Input address auto-populate 
    this feature helps user with proper entry of address in the address field to aid in calculating the correct distance.

-   User log details (device, browser, os, ip address etc)
    this is code to get user device type, including os, browser type, and user ip address and saves this to the database. 

-   Distance Calculator between the business address and user/customer's home address


##flows for admin
- super admin sends login details to admin of business
- admin logs in with details set by super admin
- if business address is not set, a default message is shown to prompt them to do that
- admin will enter or modifies changes in settings page including entering logo for the business, company name, business address, etc. 

##flows for user
- user enteres link of business address
- if there is a match, the business details shows on the page including logo, company name, company address
- user enters address properly with google geocoding auto populate, clicks submit and the details gets saved to db alongside their device logs, the url parameter, and a sweetalert message to show success.

##links
    #super admin
        - super-admin -> https://fiwithbitcoin.com/walkit/super_admin/index.php
        - super-admin-add_admin -> https://fiwithbitcoin.com/walkit/super_admin/add-admins.php
        - super-admin-manage_admin_details -> https://fiwithbitcoin.com/walkit/super_admin/manage-admins.php

    admin
        - admin-dashboard -> https://fiwithbitcoin.com/walkit/admin/index.php
        - admin_user-logs -> https://fiwithbitcoin.com/walkit/admin/view-logs.php

    homepage
        - users view -> https://fiwithbitcoin.com/walkit/index.php


## Project Template and tools/tech stack used

    Front End - Bootstrap 4.6 Default Template
    Jquery 3.5.1
    fontawesome icons
    Ajax
    php 7.4


## How to Install

    - Requirement: Local Server - XAMPP, WAMPP, Laragon or mamp etc

    - copy/extract/clone this project to your pc www folder

    - create a database in phpmyadmin named "walkit" and import walkit.sql file

    - open directory on any browser to see the views


## Screenshots

https://fiwithbitcoin.com/walkit/img/index1.png
https://fiwithbitcoin.com/walkit/img/index2.png
https://fiwithbitcoin.com/walkit/img/index3.png
https://fiwithbitcoin.com/walkit/img/index4.png
https://fiwithbitcoin.com/walkit/img/index5.png



## Database Schema
    ## users table for admins
        user_id int(11)
        names varchar
        country varchar 
        mobile_code varchar
        mobile_no varchar
        email varchar
        company_name varchar
        logo varchar
        address varchar
        url varchar
        password varchar
        verification_code varchar
        registered_on (time stamp)

    ## data_accumulator table for user logs
            id int(11)
            company_user_id int
            user_home_address varchar
            ref varchar
            km_saved varchar
            ip varchar
            device varchar
            os varchar
            browser varchar
            submitted_on varchar

    

           
