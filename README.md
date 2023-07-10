<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Bugloos TesT
This test is built under the Laravel framework and uses a MySQL database to store data.
### Commands
- **php artisan log:todb**

By default (log.txt) is inside storage/logs/ directory and your sample text there.
This command insert all lines of file to database and prevent insert duplicate line depend on execute_time and service_name field in database.

## Api services

### 1 - Insert log lines from file into database
GET http://your-localhost/log-to-db

### 2 - Register your information
POST http://your-localhost/auth/register

Parameter required
- **name**
- **email**
- **password**

### 3 - Register for login
GET http://your-localhost/auth/register

Parameter required
- **name**
- **email**
- **password**

### 3 - Login and take token for all other api.
GET http://your-localhost/auth/register

Parameter required
- **email**
- **password**


### 4 - Counts of log line
GET http://your-localhost/logs/count

Filters in query string
- **ServiceNames**
- **startDates**
- **endDates**
- **statusCode**


### How to work
- Install project and rung migrations file
- You can run command: php artisan log:todb OR call api http://your-localhost/log-to-db for insert logfiles in database
- Register with email
- Login and get token
- Use GET logs/count api
