# README
This small php app allows managing the htpasswd file via web.

This project assumes you are using a web server such as Apache or Nginx that can use htpasswd files, and that you have the htpasswd program installed.

Visit [Apache](https://httpd.apache.org/docs/current/programs/htpasswd.html) for more info on htpasswd.


## Create initial htpasswd file
If you don't already have an htpasswd file, create one.  You can use existing ones, too.

Use the following command to create a new htpasswd file using Bcrypt as encryption for passwords.

You can use any filename in place of <b>`.htpasswd`</b> below.  You can replace <b>`testuser`</b> with any username.

```
htpasswd -c -B .htpasswd testuser
```

The `-c` means to create the file, and the `-B` is for using Bcrypt for password hashing.


## Set the htpasswd filename in the php file
Be sure you change the path/filename for the htpasswd file in the php file.

Change the <b>`$file`</b> variable to the correct filename between the single quotes.

``
$file = '.htpasswd';
``

## Security notes
If you put the htpasswd file in a web-accessible area, you are asking for security issues.<br>
<em>Please visit the link below regarding Apache htpasswd security considerations.</em>

- If you are going to place the htpasswd file in a web-accessible folder for some reason, <u>at least</u>:
  - password-protect the folder, or
  - use an .htaccess file to prevent viewing the htpasswd file online ([more on htaccess](https://httpd.apache.org/docs/current/howto/htaccess.html))
 

This php app uses Bcrypt to hash passwords, the default for the password_hash() function.<br>
(See [PHP Manual](https://www.php.net/manual/en/function.password-hash.php) for details.)

The apache user (apache or www-data) will need write access to the htpasswd file.

Visit [this Apache page](https://httpd.apache.org/docs/current/programs/htpasswd.html#security) for more info on security considerations.


#### Created by
Jacob "Isreal" - [https://www.jinet.us/dev/dev-projects/php-htpasswd/]
