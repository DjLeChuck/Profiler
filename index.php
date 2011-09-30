<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title>Profiler Exemple</title>
</head>
<body>

    <p>The profiler is ready!</p>
    <p>Take a look at the bottom of the page.</p>
    <p>
        <small>You know you can press Shift + P to toggle the Profiler's visibility?</small>
    </p>
    <?php
        $libraryPath = './libraries/Profiler/';
        $frontControllerPath = str_replace(pathinfo(__FILE__, PATHINFO_BASENAME), '', __FILE__);
        require_once $libraryPath.'Profiler.php';
        
        // $_POST
        $_POST['test'] = 'Hello World!';
        $_POST['arrayTest'] = array(
            'foo' => 'bar',
            'foobar' => array(
                'John', 'Smith'
            ),
        );
        
        // $_GET
        $_GET['product_id'] = 10;
        
        // Queries
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
        
        // No session
        
        $profiler = new Profiler($frontControllerPath, $libraryPath, $queriesArray);
        
        
        echo $profiler->display();
    ?>

</body>
</html>
