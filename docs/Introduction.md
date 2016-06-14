Introduction
============

# Configuration

The module can provide configuration of system controllers. By convention,
this configuration should be located in a separate file `controllers.config.php`
in the configuration directory of module. This file must be included with the
system configuration file:
```
project/
    module/
        ExampleModule/
            Module.php
            config/
                system.config.php
                controllers.config.php
            src/
            ...
```

The file `project/module/ExampleModule/config/system.config.php`:
```
return [
    'controllers' => require 'controllers.config.php',
];
```

The file `project/module/ExampleModule/config/controllers.config.php`:
```
return [
    'ExampleModule.Controller.Index' => 'ExampleModule\Controller\IndexController',
    'ExampleModule.Controller.Bar'   => 'ExampleModule\Controller\BarController',
    // ...
];
``` 

# Convention

This should not be mandatory, to class of controller must be inherit any class.

The files with controller classes should be located in the `Controller` directory.
For directories is allowed any level of nesting:

- `ExampleModule/src/Controller/IndexController`
- `ExampleModule/src/Controller/Frontend/IndexController`
- `ExampleModule/src/Frontend/Controller/IndexController`

The controller classes must be ended with the `Controller` postfix:

- `IndexController`
- `FooController`
- `BarController`

The name of the controller action must be ended with the `Action` postfix:

- `indexAction`
- `fooAction`
- `barAction`

The action may accept as arguments:
- As first argument - an instance of the `Psr\Http\Message\ServerRequestInterface`
- As second argument - an instance of the `Psr\Http\Message\ResponseInterface`
