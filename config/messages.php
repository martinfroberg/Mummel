<?php
//WORDS
define('COMMENTS', "Kommentarer");
define('EMAIL', "Email");
define('PASSWORD', "Lösenord");
define('CONFIRM_PASSWORD', "Bekräfta lösenord");
define('CLOSE', "Stäng");
define('LOGIN', "Logga In");
define('REGISTER', "Registrera");
define('LOGIN_WITH_YOUR_EMAIL', "Logga in med din Email.");
define('LOGOUT', "Logga ut.");



//BUTTONS

//threads
define('CREATE_NEW_THREAD', "Skapa ny tråd.");

//Comments
define('NEW_THREAD_COMMENT', "Kommentera på tråd.");
define('NO_COMMENTS', "Den här tråden har inga kommentarer än.");



//SUCCESS MESSAGES

define('SUCCESSFULLY_LOGGED_IN', "Du har blivit inloggad.");
define('SUCCESSFULLY_REGISTRATED', "Du har blivit registrerad och kan nu logga in.");



//ERROR MESSAGES


//user messages

//Locked user
define('TOO_MANY_LOGIN_ATTEMPTS', "För många misslyckade försök! Ditt konto har blivit låst i 2 timmar.");

//Login
define('INCORRECT_EMAIL_OR_PASSWORD', "Du har skrivit fel email eller lösenord.");
define('ENTER_EMAIL_AND_PASSWORD', "Skriv in Email och lösenord.");
define('USER_DOES_NOT_EXIST','Användaren existerar inte.');

//Register
define('EMAIL_IS_NOT_VALID', "Emailen du skrivit in är inte giltlig.");
define('EMAIL_ALREADY_EXISTS', "Emailen existerar redan.");
define('PASSWORD_TOO_SHORT', "Lösenordet måste minst vara 6 karaktärer långt.");



//devoloper messages

//Statements
define('GET_CATEGORIES_RESULT_ERROR','ngt fel');
define('GET_CATEGORIES_QUERY_EXECUTION_ERROR','ngt fel');
define('GET_CATEGORIES_QUERY_ERROR','');

define('INSERT_COMMENT_QUERY_EXECUTION_ERROR','ngt fel');
define('INSERT_COMMENT_QUERY_PARAMETERS_ERROR','ngt fel');
define('INSERT_COMMENT_QUERY_ERROR','');

define('INSERT_THREAD_QUERY_EXECUTION_ERROR','ngt fel');
define('INSERT_THREAD_QUERY_PARAMETERS_ERROR','ngt fel');
define('INSERT_THREAD_QUERY_ERROR','');

define('GET_COMMENTS_RESULT_ERROR','ngt fel');
define('GET_COMMENTS_QUERY_EXECUTION_ERROR','ngt fel');
define('GET_COMMENTS_QUERY_PARAMETERS_ERROR','ngt fel');
define('GET_COMMENTS_QUERY_ERROR','ngt fel');

define('LOGIN_RESULT_ERROR','ngt fel');
define('LOGIN_QUERY_EXECUTION_ERROR','ngt fel');
define('LOGIN_QUERY_PARAMETERS_ERROR','ngt fel');
define('LOGIN_QUERY_ERROR','ngt fel');

define('BRUTE_FORCE_QUERY_EXECUTION_ERROR','ngt fel');
define('BRUTE_FORCE_QUERY_PARAMETERS_ERROR','ngt fel');
define('BRUTE_FORCE_QUERY_ERROR','ngt fel');

//Database
define('DATABASE_CONNECTION_ERROR','Kan inte får kontakt med databasen.');

//HTTP
define('INVALID_POST_REQUEST', "Okänt fel.");
