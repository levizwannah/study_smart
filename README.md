# The Wiki
check the wiki https://github.com/levizwannah/study_smart/wiki
# study_smart
A system to help students organize tasks.

Currently the system helps students only remember what they are to do. this makes it have less info for each task because the assumption is that a student knows what they are to do, they just need to be reminded.  
We think that a student doesn't need to rewrite the task, if they want to, there are other tools out there. This one is to just keep them reminded. 

# functionalities needed
- Sharing: Students should be able to share assignments with each other, with every maintaining their own version if necessary.
- Class creation: In school, there are classes which have similar assignments. When someone adds an assignment or group work to a class, it should be seen by everyone. 
- 

# Instructions
1. clone the repo.
2. in the root directory, run `npm install`
3. after, run `composer install`
4. Make sure your server is turned on
5. create a mysql database smart_study_db
6. then run `php study_smart --migrate`: This will put the tables in the database. please note that every data in the table will be cleared. Only the catergory table gets populated after the migration 

# Setting up the email 
1. make sure you have an email for sending emails. In the google account of the email you will use to send, set allow from less secure sources.
2. create a file called `passwords.inc.php` in the `src/includes` directory. copy the code in the `example-passwords.inc.php` file in the same repository and place it in the new file.
3. then populate the password, email, and email tagline fields.

# exposing localhost
use ngrok from ngrok.com

# questions
please open an issue

# Directory Structure

