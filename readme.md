## Парсер новых серий на LostFilm
#### Установка
* git clone https://github.com/SupGordan/lostfilm-parser.git parser
* cd parser
* composer install
* Создайте базу данных и настройте подключение к ней в .env (Пример для создания - .env.example)
* php artisan key:generate
* php artisan migrate 
* php artisan serve - для запуска окружения

#### Использование
 Спарсить все новые серии на LostFilm: 
```
    php artisan parse
```
Последующие запуски команды будут добавлять только те серии, которые не были добавлены до этого

Для того чтобы перезаписать все серии нужно выполнить данную команду с аргументом all
```
    php artisan parse all
```

На главной странице сайта будет таблица со всеми материалами по 10 серий на странице

#### Добавление команды в Cron
 Для того чтобы выполнять парсинг по крону нужно добавить системный cron, который позволит управлять планированием задач посредством Laravel
 ```
 * * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
 ```
 > path-to-your-project - путь до laravel проекта
 
 После этого Laravel будет автоматически выполнять эту команду каждый день в полночь
 Для изменения интервала нужно изменить в файле `App/Console/Kernel.php` процедуру `schedule`.
 ```php
 $schedule->command('parse')
            ->daily();
 ```
 > daily() заменить на необходимый интервал
 
 Различные интервалы можно найти в официальной документации или на сторонних ресурсах([ссылка](https://laravel.ru/docs/v5/scheduling#настройки))
 