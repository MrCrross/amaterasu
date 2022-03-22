# amaterasu
Проект на Laravel - framework языка программирования php.
В documents есть пример пояснительной записки с данным фреймворком.

Для запуска проекта на локальной машине необходимо 4 вещи:

1. веб-сервер (apache, nginx)
2. mysql-сервер
3. php 7.1
4. composer

Всё перечисленной есть в Xampp 
(https://www.apachefriends.org/xampp-files/7.4.28/xampp-windows-x64-7.4.28-0-VC15-installer.exe) + 
composer (https://getcomposer.org/Composer-Setup.exe).

Все миграции находятся в папке database/migrations. 
Каждый файл это скрипт на создание таблиц.
Все маршруты в папках routes/api для работы с данными и routes/web для вывода пользователю. 

В documents есть dump базы данных с данными для тестирования (amaterasu.sql).


