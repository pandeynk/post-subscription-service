### Installation

-   Clone the repository on your local and do composer install
-   Update the .env file to change database credentials, similar to my changes. (Update the values as per your db and credentials)

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=post_subscription_service
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=database
```

-   Make sure queue connection is database in .env file
-   Run database migrations with `php artisan migrate`

### APIs

I have added few APIs in order to test the complete flow

```
  POST       api/users .......................................................................... UserController@store
  GET|HEAD   api/users .......................................................................... UserController@index
  POST       api/websites .................................................................... WebsiteController@store
  GET|HEAD   api/websites .................................................................... WebsiteController@index
  POST       api/websites/{website}/posts ....................................................... PostController@store
  POST       api/websites/{website}/subscribe ....................................... SubscriptionController@subscribe

```

#### POST : /api/users

Sample Payload

```
{
    "name": "Test User 1",
    "email": "testuser1@example.com",
    "password": "Yellow*99"
}
```

#### POST : /api/websites

Sample Payload

```
{
    "name": "Google",
    "url": "https://google.com"
}
```

#### POST : /api/websites/1/posts

Sample Payload

```
{
    "title": "Post 1",
    "content": "Post 1 Content",
    "slug": "post_1"
}
```

#### POST : /api/websites/1/subscribe

Sample Payload

```
{
    "email": "testuser1@example.com"
}
```

## Command

Then we can run `php artisan send:post-emails` to send mail notifications to all the subscribers for new posts.
This can be verified in jobs table (for now is managed with database connection and jobs table)
