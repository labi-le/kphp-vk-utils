# vk-utils

[![GitHub license](https://img.shields.io/badge/license-BSD-green.svg)](https://github.com/labi-le/vk-utils/blob/main/LICENSE)
[![Packagist Stars](https://img.shields.io/packagist/stars/labile/vk-utils)](https://packagist.org/packages/labile/vk-utils/stats)
[![Packagist Stats](https://img.shields.io/packagist/dt/labile/vk-utils)](https://packagist.org/packages/labile/vk-utils/stats)

[Документация на русском языке](README_RU.md)

## Installation

`composer require labile/vk-utils`

## How to use it?

### Simple request

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
use Astaroth\VkUtils\Execute;
use Astaroth\VkUtils\Requests\Request;

$api = new Execute;
$api->setDefaultToken('PUT ACCESS TOKEN');
$execute = [
    new Request('wall.get', ['owner_id' => 1]),
    new Request('wall.get', ['owner_id' => 2]),
    // ...more request
    new Request('wall.get', ['owner_id' => 25]),
    ];

$response = $api->send($execute);
```

### Using the required api version

```php
use Astaroth\VkUtils\Client;

$api = new Client('5.131');
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
use Astaroth\VkUtils\Builders\Attachments\Message\Graffiti;
use Astaroth\VkUtils\Builders\Attachments\Photo;
use Astaroth\VkUtils\Builders\Attachments\Video;
use Astaroth\VkUtils\Uploader;
use Astaroth\VkUtils\Builders\Attachments\Message\AudioMessage;

$uploader = new Uploader();
$uploader->setDefaultToken('PUT TOKEN');

$attachments = $uploader->upload
(
    new Photo("dog.jpg"),

    new AudioMessage('meow.mp3'),
    
    //downloading from the link temporarily does not work
    (new Video('https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4'))
        ->setName('4 Biggers Escapes')
        ->setDescription('The video has nothing interesting, just an example')
        ->setWallpost(true),

    new Graffiti('cat.png')
);
```

#### Builder

```php

use Astaroth\VkUtils\Builders;
use Astaroth\VkUtils\Builders\Message;
use Astaroth\VkUtils\Builders\Post;

$token = 'PUT TOKEN';

$builder = new \Astaroth\VkUtils\Builder();

$builders[] = (new Message)
    ->setMessage("hi me name is lola! im lol")
    ->setPeerId(418618);

$builders[] = (new Post)
    ->setMessage("hello subscribers")

$response = $builder->create(...$builders)
);
```
