# Queuestatus
Allows you to get basic details of your Laravel Queue Stack

![image](https://user-images.githubusercontent.com/325502/152027753-6d50147b-d15d-4d5a-85cd-eec6ab167b0a.png)


# Installation

> Composer require tobya/Queuestatus

# Usage

> php artisan queue:status 

> php artisan queue:status --queue=email

You can also view job models

> php artisan queue:jobs

You keep showing status by using --live and choose to change the default pause of 3 seconds.

> php artisan queue:status --live --pause=5

# Requires

Only works when you are using a database for your queue.  Wont work with Redis etc.
