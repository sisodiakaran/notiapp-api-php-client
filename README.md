Notiapp API PHP Client
======================

Notiapp API PHP Client is a client that authenticate users on Notiapp via Notiapp API and send notifications directly to their desktop.

## How to use:

* Include Notiapp PHP Class
    ``` require_once('Notiapp/class.notiapp.php'); ```
* Create object
    ``` $notiapp = new Notiapp(); ```
* Start accessing the functions

## Basic Flow
* Step 1: To begin with, you'll need to ask Noti for a "request token". Once you have received the request token from Noti, you should redirect your user to the URL provided by Noti.
* Step 2: The user will be displayed a login page and asked if they wish to permit your application to send them notifications. Once they have authorized your application they will be redirected to your application.
* Step 3: When the user has returned to your application, you can exchange the request token for an access token which will be used to authenticate any future requests to the API (for example, whenever you send a notification).
* Step 4 (optional): Send the user a "welcome" notification letting them know the authorization process is completed.
