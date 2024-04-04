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

