# study_smart
A system to help students organize tasks

# Instructions
1. clone the repo.
2. in the root directory, run `npm install`
3. after, run `composer install`
4. create a mysql database smart_study_db
5. then run `php study_smart --migrate`

# Setting up the email 
1. make sure you have an email for sending emails. In the google account of the email you will use to send, set allow from less secure sources.
2. create a file called `passwords.inc.php` in the `src/includes` directory. copy the code in the `example-passwords.inc.php` file in the same repository and place it in the new file.
3. then populate the password, email, and email tagline fields.

# exposing localhost
use ngrok from ngrok.com

#questions
please open an issue
