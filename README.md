
# PHP for Beginners Notes

#### This follows the [PHP for beginners](https://laracasts.com/series/php-for-beginners-2023-edition/episodes/1) series on Laracasts.
#### Relevant code and notes will be here.

## I. The Fundamentals

### 1. How to Choose a Programming Language
The correct choice depends on what you want to do.
* Wordpress / Laravel shop is the perfect situation for PHP.
* If you work with Shopify, you'll likely learn Ruby.
* (Not discussed in course) R or Python are great options for MLG

----

### 2. Tools of the Trade
> You are constantly inundated with choices you are not yet qualified to make.

Necessary Tooling
* Good code editor: [PHPStorm](https://www.jetbrains.com/phpstorm/), [VSCode](https://code.visualstudio.com/), or [Sublime Text](https://www.sublimetext.com/) are good options
* A Terminal is necessary; Windows and Mac 'ship with those out of the box', but you can use iTerm or Warp.
* PHP and MySQL, with [Homebrew](https://brew.sh/)(exclusively Mac) or [Composer](https://getcomposer.org)
* [Laragon](https://laragon.org/) is popular for Windows
* Docker, maybe

----

### 3. Your First PHP Tag
The directory you're working in needs to be the same as the root directory for your local environment.

`php -h` gives help
`php -S` lets you run your own development server
'index' is the default file name

```php
<h1>
    <?php echo "Hello World"; ?>
</h1>
```

----

### 4. Variables
Concatenation in PHP is done with `.`.
Variables are defined by `$` and characters.
Nesting is done inside `""` characters.

----

### 5. Conditionals and Booleans
> Think of a conditional as a way to create a branch in your project, or more simply, a way to ask a question.

Quick way to echo a message:
```php
<?= $variable ?>
```

----

### 6. Arrays
Define array
```php
$books = [
	"Do Androids Dream of Electric Sheep",
	"The Langoliers",
	"Hail Mary"
];
```
To render only
```php
echo "<li>{$book}™</li>";
```

Simple foreach
```php
<ul>
	<?php foreach ($books as $book) : ?>
		<li><?= $boook; ?></li>
	<?php endforeach; ?>
</ul>
```	

----

### 7. Assosciative Arrays
```php
<?php
$books = [
	[
		'name' => "Do Androids Dream of Electric Sheep",
		'author' => 'Philip K. Dick',
		'purchaseUrl' => 'http://example.com'
	],
	[
		'name' => "The Langoliers",
		'author' => 'Andy Weir',
		'purchaseUrl' => 'http://example.com'
	],
];
?>

<?php foreach ($books as $book) : ?>
	<ul>
		<li><a href="<?= $book['purchaseUrl'] ?>"><?= $book['name']; ?></a></li>
		<li>Author: <?= $book['author']; ?></li>
	</ul>
<?php endforeach; ?>
```

----

### 8. Functions and Filters
Filter using `if()`
Defining functions:
```php
function filterByAuthor($books, $author = 'Andy Weir')
{
	$filteredBooks = [];
	foreach($books as $book_
	{
		if($book['author'] === $author)
			$filteredBooks[] = $book;
	}
	return $filteredBooks;
}

foreach(filterByAuthor($books) as $book { /* ... */ }
```

----

### 9. Lamda functions
You don't have to name a function; you can assign to variable directly.
Meaning, you can do cool stuff like this:
```php
function filter($items, $fn)
{
	$result = [];

	foreach ($items as $item)
		if ($fn($item))
			$result[] = $item;

	return $result;
}


foreach (filter($books, function ($book) {
	return $book['year'] >= 2000; // Returns boolean
}) as $book) {}
```

Or, you can use `array_filter()` instead.

----

### 10. Separate Logic From the Template
You can separate your HTML and core PHP into different files, then connect them using `require` or `include`

----

### 11. Technical Check-in #1 (With Quiz)
![Quiz 1](images/quiz-1.png)

----
----

## II. Dynamic Web Applications

### 12. Page Links
Took a Tailwind Dashboard starting page, the code can be found [here](https://laracasts.com/comments/28972)
Basic changes.

----

### 13. PHP Partials
Extracted the `heading`, `nav`, `banner` and `footer` sections as **partials**.

----

### 14. Superglobals and Current Page Styling
There are SuperGlobals like `$_POST`, `$_GET`, `$_SESSION` and `$_SERVER`.
You can extract a file like `functions.php`:
```
<?php
function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] == $value;
}
```
Then call this file in every relevant file.

----

### 15. Make a PHP Router
```php
$uri =  parse_url($_SERVER['REQUEST_URI'])['path'];
$uri = $uri == '/' ? '/' : rtrim($uri, '/');

$routes = [
    '/' => 'controllers/index.php',
    '/about' => 'controllers/about.php',
    '/contact' => 'controllers/contact.php'
];

function abort($code = 404)
{
    http_response_code($code);
    $heading = $code;
    require 'views/404.php';
    die();
}

function routeToController()
{
    global $routes, $uri;

    if (array_key_exists($uri, $routes))
        require $routes[$uri];
    else {
        abort();
    }
}

routeToController();
```

----

### 16. Create a MySQL Database
Created a simple database with one table, `posts`.

----

### 17. PDO First Steps
Basic SQL `SELECT` query.
`PDO` stands for 'PHP Database Object'

Introduced classes, objects.

Declare new instance of PDO:
```php
$dsn = "mysql:host=localhost;port=3306;dbname=learning_php;user=root;charset=utf8mb4";
$pdo = new PDO($dsn);

$stmt = $pdo->prepare("SELECT * FROM posts");
$stmt->execute();

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
```

----

### 18. Extract a PHP Database class
Extracted functions into Database class with a `__construct` method that creates the initial connection

----

### 19. Environments and Configuration Flexibility
`http_build_query()` can take a separator as a parameter.

Meaning, you can take and assosciative array, pass it like so:
```php
http_build_query($assosciativeArray, '', ';');
```
And it will return `{$assosciativeArray[$key]}={$assosciativeArray[$value]};` for every key-vaule pair.

Config example:
```php
<?php
return [
    'database' => [
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => 'learning_php',
        'charset' => 'utf8mb4'
    ],
];
```

Calling example:
```php
$db = new Database((require 'config.php')['database']);
```

----

### 20. SQL Injection Vulnerabilities Explained
Sometimes a user can insert query inside the query string, like `example.com?id=1;drop table users`
2 ways around this:
1. Replace it with a `?`:
```php
$query = "select * from posts where id = ?";
$db->query($query)->execute([$id]);
```
2. Declare it as a variable like `:id`
```php
$query = "select * from posts where id = :id";
$db->query($query)->execute(['/*:*/id' => $id);
```

----
----

## III. Notes Mini-Project

### 21. Database Tables and Indexes
Created `FK` and `ON DELETE CASCADE` for `notes` and `users` tables.

----

### 22. Render the Notes and Note Page
Made the `notes` page showing a list of notes using a `user_id` and then displayed the entire note on a separate page `note` page.

----

### 23. Introduction to Authorization
Made the program differentiate between user and note.
`404` if the note doesn't exist and `403` if the note exists, but you're forbidden from seeing it.
Only if `user_id` = 1, though, so no session / login yet.

----

### 24. Programming is Rewriting
[!IMPORTANT]
Crucial **refactoring** chapter

You might want to do something like `fetchOrAbort()`, that uses a built-in function you own and adds onto that.
It is possible.

Example:
```php
public function query($query, $params = [])
{
	$stmt = $this->connection->prepare($query);
	$stmt->execute($params);

	return $stmt; // Returns PDO object
	
	// Fix:
	// return $this;
}
```
By returning `$this`, you can make your own `fetch()` method.
* Problem with this: the `$stmt` variable is outside the scope.
* Solution: return `$this` a few places as opposed to the `PDO` object; make a `private`/`protected` variable in-scope to use it.


Sometimes, you might want to override the default so as NOT to give the user information
```
function authorize($authorized = false, $status = Response::FORBIDDEN)
{
    if (!$authorized)
        abort($status);
}
```

----

### 25. Intro to Forms and Request Methods
#### General naming convention for route naming
1. `/notes` would be all
1. `/note` would be a specific unit
1. `/notes/:note` would show a single note 
1. `/notes/create` would let the user create a note

The reason `note`-related files start like `note(s)-` is to keep them pretty close to one another alphabetically.

#### Forms
`GET` requests are considered ***idempotent***, meaning nothing is changed no matter how many times you run the operation.

Refreshing a page runs a `GET` request, but `POST` usually only runs once you click a button.

Check `$_SERVER` variable for `POST` request:
```php
if($_SERVER['REQUEST_METHOD'] == 'POST')
```

You can access it using the `$_POST` variable.

----

### 26. Always Escape Untrusted Input
Used `htmlspecialchars()` to sanitize data and prevent scripts from running.

----

### 27. Intro to Form Validation
Basic validation

----

### 28. Extract a Simple Validator Class
A `pure function` is not dependent on a state or value from the outside program.
There is no external state being referenced or different class being deferred to.

This means the function can be made `static`, and therefore called like so:
```php
Class::function();
```

----
----

## IV. Project Organization

### 29. Resourceful Naming Conventions
`index` for displaying all, `show` for showing specific one(s) and `create`.

----

### 30. PHP Autoloading and Extraction
> If you typically work along in your own code editor for each video, maybe for this lesson alone, don't do that.

`extract()` turns an array (e.g., `['example' => 'Example text']`) into a collection of of variables (e.g., `$example = 'Example text`).

Functions like `base_path()` and `view()` help loads with making the program more modular.

Automatically instantiate classes as needed:
```php
spl_autoload_register(function ($class) {
    require base_path($class . '.php');
});
```

----

### 31. Namespacing: What, Why, How?
Namespaces are essentially like categorising.

----

### 32. Handle Multiple Request Methods From a Controller Action?
`<a>` tags are idempotent, so they cannot be used to delete.

Basic authentication before deleting.

Used a hidden input to pass the value of the `note_id` to the server.

----

### 33. Build a Better Router
Essentially recreated part of the Laravel `Route` functionality as used in `web.php`.

----

### 34. One Request, One Controller
All separate functionalities were moved into their own file.

----

### 35. Make Your First Service Container
`Container.php` manages bindings and resolves dependencies:
```
<?php

namespace Core;

class Container
{
    protected $bindings = [];

    public function bind($key, $resolver)
    {
        $this->bindings[$key] = $resolver;
    }

    public function resolve($key)
    {
        if (!array_key_exists($key, $this->bindings))
            throw new \Exception('No matching binding found for {$key}.');

        return call_user_func($this->bindings[$key]);
    }
}
```

`bootstrap.php` sets up the dependency injection container by binding classes and making them available globally:
```
<?php

use Core\App;
use Core\Container;
use Core\Temp;

$container = new Container();

$container->bind('\Core\Temp', fn() => new Temp();

App::setContainer($container);
```

`App.php` makes the container available:
```
<?php

namespace Core;

class App
{
    protected static $container;

    public static function setContainer($container)
    {
        static::$container = $container;
    }

    public static function container()
    {
        return static::$container;
    }

    public static function bind($key, $resolver)
    {
        static::container()->bind($key, $resolver);
    }

    public static function resolve($key)
    {
        return static::container()->resolve($key);
    }
}
```

Now you call it using:
```
$temp = \Core\App::resolve(\Core\Temp::class);
```

----

### 36. Updating With PATCH Requests
Added `hidden inputs` to pass the Request to the server; there was validation and some authorization.

----

### 37. PHP Sessions 101
You have to `session_start()` in order to get session data.

To get information about the session, among other things, you can run `php [-i/--info]`

To get where the session data is being stored, run `sys_get_temp_dir()`.

----

### 38. Register a New Use.
Used sessions and did validation where appropriate.

----

### 39. Introduction to Middleware
> A middleware is sort of like a bridge that will take us to an initial request to the core of your application
That bridge has the ability to do anything it wants; now, it wants to authorize the user.

Middleware can be done if you `return $this` instance on your `Router`, then chain methods like `->only()`.

In your `Middleware` class, you should 'register' / log / map your middleware classes.

Having a `resolve()` method to take a value from the session makes your `route()` method look more readable.

```php
<?php

namespace Core\Middleware;

class Middleware
{
    public const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public static function resolve($key)
    {
        if (!$key) return;

        $middleware = Middleware::MAP[$key] ?? false;

        if (!$middleware)
            throw new \Exception("No matching middleware found for key $key");

        (new $middleware)->handle();
    }
}
```

----

### 40. Manage Passwords Like This For The Remainder of Your Career
**NEVER** store passwords as plaintext.

In PHP, you can call a function `password_hash()` and choose the default, which probably is `BCRYPT`.

You can use `password_verify()` to check the values in the database against the one supplied.

----

### 41. Log In and Log Out
Same old validation, with a `sessions_destroy()` function, that deleted all `$_SESSION` values.

When logging in, using 	`session_regenerate_id(true);` will prevent old sessions from being used maliciously.

Logging out can be done as follows:
```
function logout()
{
    $_SESSION = [];
    session_destroy();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
```

----
----

## VI. Refactoring Techinques

### 42. Extract a Form Validation Object
Created a new `Http/` directory for various webpage-specific logic, like controllers and .

The reason the `Forms/` directory (used for validation) was not put in `Core/`, is because it really is separate from the core.
It will be used specific to forms like `login`, not by programs / classes that handle payment processing, for example.

----

### 43. Extract an Authenticator Class
> It should not be the responsibility of the `Authenticator` class (or any calss for that matter) to load `views`; 
that should be done by the controllers.

> Whenever you're in a situation where you have 2 pieces of code that are mostly the same, but slightly different, instead, see if you
can make whatever changes necessary to make those pieces of code identical.

Example:
```
if ((new LoginForm())->validate($email, $password))
    return view('session/create.view.php', ['errors' => $form->errors()]);

if ((new Authenticator())->attempt($email, $password)) {
    return view('session/create.view.php', [
        'errors' => ['email' => 'Credentials could not be matched.']
    ]);
};
```

The only difference between these two is the second is hard-coded.

This could be a sign to append a new error to the `LoginForm`.

----

### 44. The PRG Pattern (and Session Flashing)
***PRG: Post-Redirect-Get***

Problem: on refresh or navigating back, the page that was `POST`-ed stays as a `POST`.
You have to `redirect` and not `return view()`. 

You can get around not being able to pass variables like `error` messages by using the `$_SESSION` variable.
Using a key like `['_flash']`, especially with an underscore, is preferable in order to keep it separate from 
potential keywords in the application / framework. `unset()`
Even better, create constants.

----

### 45. Flash Old Form Data to the Session
The problem with unsetting `$_SESSION` is not being able to display old data on page reload.
You can create an `old()` function to do this for you.

----

### 46. Automatically Redirect Back Upon Failed Validation
