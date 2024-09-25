# Render, please - теперь и на PHP!
**Render, please** - библиотека, созданная для рендера аватаров, отсылаемых клиентом онлайн-игры Шарарам
## Установка
Скопируйте файл `renderer.php` в корень вашего веб-сервера (или любое другое удобное для вас место)

## Использование
1. Вывод аватара
```php
<?php
require_once('renderer.php');
header('Content-Type: image/png');
$renderer = new Renderer();
echo $renderer->render($_POST['avatar'], 'png'); // выведет PNG аватара, срендеренного из POST параметра "avatar"
```
2. Сохранение аватара в файл
```php
<?php
require_once('renderer.php');
$renderer = new Renderer();
$renderer->render($_POST['avatar'], 'png', 'avatar.png'); // сохранит PNG аватара, срендеренного из POST параметра "avatar", в файл 'avatar.png'
```

Доступны следующие методы:
- `render($ava, $type = 'jpeg', $file = null)`: рендер аватара $ava и последующий его вывод / сохранение в файл $file в формате $type (base64, jpeg или png)
