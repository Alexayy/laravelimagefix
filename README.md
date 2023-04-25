
## Task at hand
Given the corrupted image, fix it to display what was there. A hard task, none-the-less

## Requirements

```npm install```

```composer install```

```npm run dev```

```php artisan serve```

and for the love of Linus Torvalds, put this in the php.ini file

```
extension=php_openssl.dll
allow_url_include = On
extension_dir = "ext"
      extension=curl
      extension=mbstring
extension=php_fileinfo.dll 
```

## How To Run
Since I strugled a lot with this, i didnt have time to do frontend,
and the simple thing I tried decided to fire error 500 that I couldnt debug.
In ```ImageController.php``` in variable ```$inputFilePath``` put the adress of the image and simply run.
Fixed image should show up in ```public folder.
