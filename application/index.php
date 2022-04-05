<?php

// autoloader for Composer
require 'vendor/autoload.php';

// instanciate Slim
$app = new Slim\App();

// basic authentication
$app->add(new \Slim\Middleware\HttpBasicAuthentication(array(
    // everything inside this root path uses the authentication
    "path" => "/api",
    // deactivate HTTPS usage (for simplicity)
    "secure" => false,
    // users (name and password), credentials will be passed via request header, see the client.html for more info
    "users" => [
        "math" => "123",
    ],
    "error" => function ($request, $response, $arguments) {
        // return the 401 "unauthorized" status code when auth error occurs
        return $response->withStatus(401);
    }
)));

// grouping the /api route, see Slim's group() method documentation for more
$app->group('/api', function () use ($app) {

    // api route "test" which just gives back some demo data
    $app->get('/twoNumberCalc', function ($request, $response, $args) use ($dataForApi) {

        // Validate inputs
        if (!isset($_GET['input1'])) {
            return $response->withJson([
                'error' => 'input1 not specfied'
            ]);
        }

        if (!isset($_GET['input2'])) {
            return $response->withJson([
                'error' => 'input2 not specfied'
            ]);
        }

        if (!isset($_GET['operation'])) {
            return $response->withJson([
                'error' => 'operation not specfied'
            ]);
        }

        $param = $request->getQueryParams();

        // fetch the operation from the input.
        preg_match("/&?operation=([^&]+)/", $_SERVER['QUERY_STRING'], $matches);
        $operation = trim($matches[1], '%22');

        // build calc string
        $strTotal = $param['input1'] . $operation . $param['input2'];
        
        // calculate the total.
        $total = calc($strTotal);
        
        // Invalid number, return error.
        if (!is_numeric($total)) {
            return $response->withJson([
                'error' => 'invalid number', 
            ]);
        }
        
        // Everything went well return the calculated total.
        return $response->withJson([
            'total' => $total, 
        ]);
    });
});

/**
 * Calculate the operations based in string.
 * Use regular expression to split numbers with operator.
 */
function calc($total) {
    if(preg_match('/(\d+)(?:\s*)([\+\-\*\/])(?:\s*)(\d+)/', $total, $matches) !== FALSE){
        $operator = $matches[2];
    
        switch($operator) {
            case '+':
                $p = $matches[1] + $matches[3];
                break;
            case '-':
                $p = $matches[1] - $matches[3];
                break;
            case '*':
                $p = $matches[1] * $matches[3];
                break;
            case '/':
                $p = $matches[1] / $matches[3];
                break;
        }
    
        return $p;
    }
}

$app->run();