Step 1. Install the Contributed Modules required for the Migration.
We need to install Migrate Tools, Migrate Plus, Migrate Source CSV. By using drush and typing following you can install the module.

drush en migrate_tools -y 
drush en migrate_source_csv -y 


Step 2. Prepare the CSV file contains the User's data.

Here our CSV is...

https://gist.github.com/Praveen91/e0138a9802b9b6578c146648ede4c42c

Step 3. Create the Migrate configuration file and import the configuration

Create the migrate configuration files as like the following,

https://gist.github.com/Praveen91/8f5aac64e1b9bba24c8afb99d5f839fb

In migration, There are three things are the very important source, process, and destination.

Navigate to Administration > Configuration > Development > Synchronize (admin/config/development/configuration/single/import), select Migration under Configuration type and enter our migrate configuration into the Paste your configuration here window (note the absolute path to the .csv file) , and click import button.

Step 4. Go to terminal and run the following Drush commands.

  drush ms 
  drush mi demo_user_migration
