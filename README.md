# Render, please - теперь и на PHP!
**Render, please** - библиотека, созданная для рендера аватаров, отсылаемых клиентом онлайн-игры Шарарам
## Установка
Скопируйте файл `renderer.php` в корень вашего веб-сервера (или любое другое удобное для вас место)

## Использование
```php
<?php
require_once('renderer.php');
header('Content-Type: image/png');
$renderer = new Renderer();
echo $renderer->render($_POST['avatar'], 'png'); // выведет PNG аватара, срендеренного из POST параметра "avatar"
```
Доступны следующие методы:
- `render($ava, $type = 'jpeg')`: рендер аватара $ava и последующий его вывод в формате $type (base64, jpeg или png)
