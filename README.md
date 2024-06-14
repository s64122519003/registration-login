# registration-login
Registration and login system (PHP+MySQL)

This is an example of a registration and login system written in PHP+MySQL. The application allows users to register themselves on their first visit or log in using their existing account.

After a successful login, the login session is created and the welcome page will show up. Note that visitors cannot open the welcome page without a valid login session even though they have the URL.

The logout script kills the session.

# Editing the files
Start with the **config.php** that contains the script for MySQL database connection. After that,you can choose between **"unsafe"** and **"secured"** approaches. The unsafe approach gives you a better understanding of how it works but is more prone to user errors and security issues. We recommend that you try an unsafe approach first and learn the secured approach once you have understood the concept.

## Unsafe approach
Files to be used:
- config.php
- register.php
- login.php
- welcome.php
- logout.php

## Secured approach
The secured version uses defensive programming to prevent invalid user inputs and harmful script injection. It also utilizes the password_hash() function to secure password phrases. In addition, the HTML form is enhanced using Bootstrap.

Files to be used:
- config.php
- register_secured.php
- login_secured.php
- welcome_secured.php
- logout_secured.php
- reset_secured

Since the password_hash() is used, we cannot mix unsafe and secured scripts.
