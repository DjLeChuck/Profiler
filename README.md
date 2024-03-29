Profiler
========

Profiler is a standalone package to profile your code.

## Installation

Just download and extract the package. Configures.

## Configuration

All you have to do is to:

1.    set the relative path of your library,
2.    set the path of your front controller,
3.    instantiate the profiler with the path of the front controller, the relative path of the file and a queries' array.

Be careful, the array must respect the following skeleton:

```php
<?php

$queriesArray = array(
    array(
        'time'  => 0.0008,
        'query' => 'SELECT myField FROM myTable;',
    ),
    array(
        'time'  => 0.0010,
        'query' => 'SELECT myField FROM myTable WHERE myField > 2;',
    ),
);

$libraryPath = './libraries/Profiler/';
$frontControllerPath = str_replace(pathinfo(__FILE__, PATHINFO_BASENAME), '', __FILE__);
require_once $libraryPath.'Profiler.php';

$profiler = new Profiler($frontControllerPath, $libraryPath, $queriesArray);
```

At last, call its display method:

```php
<?php

echo $profiler->display();
```

## License

Profiler is licensed under the MIT license.
