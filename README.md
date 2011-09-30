Profiler, a standalone library for profiles your code
===============================================

Profiler is a standalone library for profiles your code.

## Installation

Just download and extract the package. Configures.

## Configuration

All you have to do is to instantiate the profiler with a queries' array.

All you have to do is to:
    * set the relative path of your library,
    * set the path of your front controller,
    * instantiate the profiler with the path of the front controller, the relative path of the file and a queries' array.

Be attentive, the array must respect the following form:

```php
<?php
$queriesArray = array(
    array(
        'time'  => 0.0008,
        'query' => 'SELECT myFiled FROM myTable;',
    ),
    array(
        'time'  => 0.0010,
        'query' => 'SELECT myFiled FROM myTable WHERE myField > 2;',
    ),
);

$libraryPath = './libraries/Profiler/';
$frontControllerPath = str_replace(pathinfo(__FILE__, PATHINFO_BASENAME), '', __FILE__);
require_once $libraryPath.'Profiler.php';

$profiler = new Profiler($frontControllerPath, $libraryPath, $queriesArray);
```

... and call his display method:

```php
<?php

echo $profiler->display();
```

## License

Profiler is licensed under the MIT license.