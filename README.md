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

After install is complete, you will need to copy `config/config.example.php` to `config/config.php` and update your settings.

### Request Class

Set `url` to one or more website addresses that you want to monitor.

### Email Class

Set `fromAddress` to your "From" email address, set `fromPassword` to your "From" email address login password, and set `recipients` to one or more email alert recipients.

## Run the script

Simply open your command line interface (CLI) tool of choice and run the following command:

```
php /path/to/index.php
```

If you did everything right, you should see no errors in your CLI.
