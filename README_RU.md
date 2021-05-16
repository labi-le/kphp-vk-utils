# vk-utils

[![GitHub license](https://img.shields.io/badge/license-BSD-green.svg)](https://github.com/labi-le/vk-utils/blob/main/LICENSE)
[![Packagist Stars](https://img.shields.io/packagist/stars/labile/vk-utils)](https://packagist.org/packages/labile/vk-utils/stats)
[![Packagist Stats](https://img.shields.io/packagist/dt/labile/vk-utils)](https://packagist.org/packages/labile/vk-utils/stats)

## Установка

`composer require labile/vk-utils`

## А как использовать?

### Простой пример

```php
use Astaroth\VkUtils\Client;

$api = new Client;

$response = $api->request('wall.get', ['owner_id' => 1]);
```

### Используем Request класс

```php
use Astaroth\VkUtils\Client;
use Astaroth\VkUtils\Requests\Request;

$api = new Client;

$request = new Request('wall.get', ['owner_id' => 1]);
$response = $api->send($request);
```

### Используем ExecuteRequest класс

Отправляем несколько запросов одновременно

```php
use Astaroth\VkUtils\Client;
use Astaroth\VkUtils\Requests\ExecuteRequest;
use Astaroth\VkUtils\Requests\Request;

$api = new Client();
$api->setDefaultToken('PUT ACCESS TOKEN');
$execute = ExecuteRequest::make([
    new Request('wall.get', ['owner_id' => 1]),
    new Request('wall.get', ['owner_id' => 2]),
    // ...много много запросов
    new Request('wall.get', ['owner_id' => 25]),
    ]);

$response = $api->send($execute);
```

### Используем необходимую версию апи

```php
use Astaroth\VkUtils\Client;

$api = new Client('5.110');
```

### Используем токен для всех запросов

Установить токен по умолчанию в клиенте

```php
use Astaroth\VkUtils\Client;

$api = new Client();

$api->setDefaultToken("PUT TOKEN");
```

Ну или можно вот так

```php
use Astaroth\VkUtils\Requests\Request;
use Astaroth\VkUtils\Client;

$api = new Client;

// Токен в запросе в приоритете над setDefaultToken
$request = new Request('wall.get', ['owner_id' => 1], "some_token");
```

### Конструкторы

#### Конструктор аплоадинга вложений

```php
use Astaroth\VkUtils\Uploader;
use Astaroth\VkUtils\Uploading\AudioMessage;
use Astaroth\VkUtils\Uploading\Graffiti;
use Astaroth\VkUtils\Uploading\Photo;
use Astaroth\VkUtils\Uploading\Video;

$uploader = new Uploader();
$uploader->setDefaultToken('PUT TOKEN');

$attachments = $uploader->upload
(
    new Photo('https://images.dog.ceo/breeds/sheepdog-english/n02105641_8701.jpg'),
    new Photo('https://images.dog.ceo/breeds/schipperke/n02104365_1292.jpg'),
    new Photo('https://images.dog.ceo/breeds/ovcharka-caucasian/IMG_20190528_194200.jpg'),

    new AudioMessage('meow.mp3'),
    
    (new Video('https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4'))
        ->setName('4 Biggers Escapes')
        ->setDescription('The video has nothing interesting, just an example')
        ->setWallpost(true),

    new Graffiti('cat.png')
);
```

#### Конструктор сообщений

```php

use Astaroth\VkUtils\Builders;
use Astaroth\VkUtils\Uploader;
use Astaroth\VkUtils\Message;
use Astaroth\VkUtils\Uploading\Photo;

$token = 'PUT TOKEN';

$uploader = new Uploader();
$message = new Message();

$uploader->setDefaultToken($token);
$message->setDefaultToken($token);


$message = $message->create(
    (new Builders\MessageBuilder())
        ->setUserId(418618)
        ->setMessage('10 Dogs')
        ->setAttachment
        (
            'photo418618_297326744',
            ...$uploader->upload
        (
            new Photo('https://images.dog.ceo/breeds/sheepdog-english/n02105641_8701.jpg'),
            new Photo('https://images.dog.ceo/breeds/schipperke/n02104365_1292.jpg'),
            new Photo('https://images.dog.ceo/breeds/waterdog-spanish/20190208_063211.jpg'),
            new Photo('https://images.dog.ceo/breeds/mountain-swiss/n02107574_2222.jpg'),
            new Photo('https://images.dog.ceo/breeds/husky/n02110185_11783.jpg'),
            new Photo('https://images.dog.ceo/breeds/pointer-germanlonghair/hans3.jpg'),
        )
        ),
    (new Builders\MessageBuilder())
        ->setUserId(418618)
        ->setMessage('2 sms'),

    (new Builders\MessageBuilder())
        ->setUserId(418618)
        ->setMessage('3 sms'),
);
```

#### Нужно больше скорости?

Включи параллельные запросы к вк

```php

use Astaroth\VkUtils\Builders;
use Astaroth\VkUtils\Uploader;
use Astaroth\VkUtils\Message;
use Astaroth\VkUtils\Uploading\Photo;
use Astaroth\VkUtils\Uploading\Video;

$token = 'PUT TOKEN';

$uploader = new Uploader();
$uploader->setDefaultToken($token);

$message = new Message();
$message->setDefaultToken($token);

Uploader::enableParallelRequest();
Message::enableParallelRequest();

//Сообщения будут отправлены параллельно!
$message = $message->create(
    (new Builders\MessageBuilder())
        ->setUserId(418618)
        ->setMessage('10 Dogs')
        ->setAttachment
        (
            'photo418618_297326744',
            ...$uploader->upload
        (
            new Photo('https://images.dog.ceo/breeds/mountain-swiss/n02107574_2222.jpg'),
            new Photo('https://images.dog.ceo/breeds/husky/n02110185_11783.jpg'),
            new Photo('https://images.dog.ceo/breeds/pointer-germanlonghair/hans3.jpg'),

            (new Video('https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4'))
                ->setName('4 Biggers Escapes')
                ->setDescription('The video has nothing interesting, just an example')
                ->setWallpost(true),
        )
        ),

    (new Builders\MessageBuilder())
        ->setUserId(418618)
        ->setMessage('кем был Заратустра?')
);
```

Необходимо быть крайне осторожным с параллельными запросами, так можно получить `flood control` от вконтакте\
Рекомендуется использовать `Uploader::enableParallelRequest()` только с токеном сообщества\
Также стоить заметить, что при использовании `Message::enableParallelRequest()` сообщения отправляются в случайном
порядке, это может быть полезно при отправке нескольких сообщений с вложениями
