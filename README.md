##########################################  Task: ################################################
1 - Create github repository, where you will add your work.
2 - Create a laravel rest API that uses Auth2 to authenticate. It should have a customer registration and allow customers to generate a token for use with auth2.

3 - Once done add to your repository and share the link.

The projects uses Vue js to handle the dashboard screen, 

Configuration:
1 - Rename .env.example to .env
2 - Open .env and modify the database connection config and the API_URL const 
    NOTE: 
        In order to run this app properly you need to set the full path to your app 
        for example http://localhost/laravel-oauth/api-and-auth/public/, or more advance
        would be modify your vHosts or .htaccess file, running it
        from the artisan cli wont work as expected
3 - Open /common.js file from the app root and modify path by the same base path link above.
4 - Run the command "php artisan passport:keys" This command generates the encryption keys 
    Passport needs in order to generate access tokens.
5 - Run the command "php artisan migrate" to generate the migartions


Usage:
Open the API_URL link in your browser, create an account, and you are good to go, you will be able to
generate an access_token that will allow you to access the api resources.

bellow you have some resourses, a basic CRUD to test the token access, you may use POST Man ou a real client app



     |
|        | POST     | api/products                            |                                   | App\Http\Controllers\ProductController@store                              | api
     |
|        |          |                                         |                                   |
                                                               | App\Http\Middleware\Authenticate:api
     |
|        | GET|HEAD | api/products                            |                                   | App\Http\Controllers\ProductController@index                              | api
     |
|        |          |                                         |                                   |
                                                               | App\Http\Middleware\Authenticate:api
     |
|        | DELETE   | api/products/{id}                       |                                   | App\Http\Controllers\ProductController@destroy                            | api
     |
|        |          |                                         |                                   |
                                                               | App\Http\Middleware\Authenticate:api
     |
|        | GET|HEAD | api/products/{id}                       |                                   | App\Http\Controllers\ProductController@show                               | api
     |
|        | GET|HEAD | api/user                                |                                   | Closure    
                                                               | api
