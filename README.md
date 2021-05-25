# Render, please - теперь и на PHP!

## Установка
Скопируйте файл `renderer.php` в корень вашего веб-сервера (или любое другое удобное для вас место)

## Использование
```php
<?php
require_once('renderer.php');
$renderer = new Renderer();
echo $renderer->render($_POST['avatar'], 'jpeg'); // выведет JPEG аватара, срендеренного из POST параметра "avatar"
```
Доступны следующие методы:
- `render($ava, $type = 'jpeg')`: рендер аватара $ava и последующий его вывод в формате $type (base64 или jpeg)
