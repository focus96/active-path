For easier control of the active punt menu for Laravel.

Simple usage:
```html
<nav>
    <item class="{{ ActivePath::isPath('news') }}">Nav Title</item>
    <item class="{{ ActivePath::isPath('news/*') }}">Nav Title</item>
    
    <item class="{{ ActivePath::isSegment(1, 'news') }}">Nav Title</item>
    <item class="{{ ActivePath::isSegment(1, ['portfolio', 'news']) }}">Nav Title</item>
</nav>
```

or blade directive:
```html
<nav>
    <item class="@isPath('news')">Nav Title</item> 
    <item class="@isSegment(1, 'news')">Nav Title</item>
</nav>
```

result:
```html
<nav>
    <item class="active">Nav Title</item> 
</nav>
```

If you have a lot of menus and also want to control the active menu items in one file, publish the configuration file, fill it in and use the method `ActivePath::isNav()` or `@isNav()`

```
php artisan vendor:publish --tag=config
```

Edit file `config/activepath.php`:
```php
<?php

return [
    // Menu name.
    'main' => [
        // Menu-item name.
        'news' => [
            // Active urls.
            'news/*',
        ],
    ],
];
```

Usage:
```html
<nav>
    <item class="{{ ActivePath::isNav('main.news') }}">Nav Title</item> 
    <item class="@isNav('main.news')">Nav Title</item> 
</nav>
```

If you have intersecting paths and you need to exclude the path, use "!" before path. Excluding paths must go first to an array:

```php
<?php

return [
    // Menu name.
    'main' => [
        // Menu-item name.
        'project' => [
            '!/project/insides/*/show', // -> /project/insides/*/show -> false',
            '/project/*/show', // -> /project/insides/*/show -> true',
        ],
        'projectInsides' => [
            '/project/insides/*/show'
        ],
    ],
];
```


Setters for settings:
```php
<?php

ActivePath::setActiveClass('other-active');
ActivePath::setInactiveClass('is-not-active-class');
ActivePath::setConfigFile('other_file_name');
```
