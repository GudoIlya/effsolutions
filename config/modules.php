<?php

return array_merge(require(__DIR__ . '/installed_modules.php'), [
    'api' => [
        'class' => 'app\modules\api\Module',
    ],
]);