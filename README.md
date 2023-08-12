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

and there is an alias for status

> php artisan queue:count

# Requires

Only works when you are using a database for your queue.  Wont work with Redis etc.
