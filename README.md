
## Sponsor

![](https://www.techverx.com/wp-content/uploads/2021/07/HighRes-Logo.png)

### Features

- This package will create the Base Service, Base Repository, Interface Repository, Seeder, Factory, Service, Repo, Model and Migration from single command.
- The name you type it creates all the files and also with the route and import statement in web.php, after that you only have logic in the function.
- You can create the code architecture by single command.
- Provide all needed files of the 3-layer architecture in laravel.

# Requirements

- PHP >= 7.0.0
- Laravel >= 5.5.0
- Fileinfo PHP Extension

# Installation

First, install laravel 5.5, and make sure that php version is 7+.

```bash
composer require techverx/filegenerator
```

Then run this command to publish：

```bash
php artisan vendor:publish --provider="Techverx\Contact\ContactServiceProvider"
```



# Command

In this command modelname could be any name e.g Post
```bash
php artisan create:model modelname --all
```
## Contributor

- Ali Haider
- Muhammad Ali
- Muhammad Anas


### End
