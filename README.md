# website-monitor
Have you ever wanted to get an email when your website becomes unresponsive? Well now you can! website-monitor was written for this sole purpose.

## Installation
Clone the repo on a machine running PHP 7.1 or higher.
```
git clone https://github.com/bmstanley/website-monitor.git
```
Install dependencies via Composer
```
composer install
```

After install is complete, you will need to go into a few files and update some of the variable values.

### Request Class
Change ```$url``` to the website address that you want to monitor.

### Email Class
Change the following properties:
```$from``` to your "From" email address.
```$password``` to your "From" email address login password.

### Index.php
Change ```$notificationRecipient``` to the desired "To" email address(es).

## Run the script
Simply open your command line interface (CLI) tool of choice and run the following command:
```
php /path/to/index.php
```

If you did everything right, you should see no errors in your CLI.
