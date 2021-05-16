# vk-utils

[![GitHub license](https://img.shields.io/badge/license-BSD-green.svg)](https://github.com/labi-le/vk-utils/blob/main/LICENSE)
[![Packagist Stars](https://img.shields.io/packagist/stars/labile/vk-utils)](https://packagist.org/packages/labile/vk-utils/stats)
[![Packagist Stats](https://img.shields.io/packagist/dt/labile/vk-utils)](https://packagist.org/packages/labile/vk-utils/stats)

[Документация на русском языке](https://github.com/labi-le/vk-utils/blob/main/README_RU.md)

## Installation

`composer require labile/vk-utils`

## How to use it?

### Simple example

```php
use Astaroth\VkUtils\Client;

$api = new Client;

$response = $api->request('wall.get', ['owner_id' => 1]);
```

### Use Request class

```php
use Astaroth\VkUtils\Client;
use Astaroth\VkUtils\Requests\Request;

$api = new Client;

$request = new Request('wall.get', ['owner_id' => 1]);
$response = $api->send($request);
```

### Use ExecuteRequest class

Sending multiple requests at the same time

```php
use Astaroth\VkUtils\Client;
use Astaroth\VkUtils\Requests\ExecuteRequest;
use Astaroth\VkUtils\Requests\Request;

$api = new Client();
$api->setDefaultToken('PUT ACCESS TOKEN');
$execute = ExecuteRequest::make([
    new Request('wall.get', ['owner_id' => 1]),
    new Request('wall.get', ['owner_id' => 2]),
    // ...more request
    new Request('wall.get', ['owner_id' => 25]),
    ]);

$response = $api->send($execute);
```

### Using the required api version

```php
use Astaroth\VkUtils\Client;

$api = new Client('5.110');
```

### Using a token for requests

Set default token in client

```php
use Astaroth\VkUtils\Client;

$api = new Client();

$api->setDefaultToken("PUT TOKEN");
```

or so

```php
use Astaroth\VkUtils\Requests\Request;
use Astaroth\VkUtils\Client;

$api = new Client;

// The token in the request takes precedence over setDefaultToken
$request = new Request('wall.get', ['owner_id' => 1], "some_token");
```

### Constructors

#### Attachment upload constructor

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

#### Message constructor

```php

use Astaroth\VkUtils\Builders;
use Astaroth\VkUtils\Uploader;
use Astaroth\VkUtils\Uploading\Photo;
use Astaroth\VkUtils\Message;

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

#### Need more speed?

Turn on parallel requests to VK

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

//Messages will be sent in parallel!
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
        ->setMessage('who was Zarathustra? ')
);
```

You need to be careful with parallel requests, this is how you can get `flood control` from VKontakte\
It is recommended to use `Uploader::enableParallelRequest()` only with the community token\
It is also worth noting that when using `Message::enableParallelRequest()` messages are sent in a random
this can be useful when sending multiple messages with attachments
