<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use function Hyperf\Support\env;

class IndexController extends AbstractController
{
    public function index()
    {

//        ob_start();
//        phpinfo();
//        $output = ob_get_clean();
//        return $output;

        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'host' => $_SERVER['HOSTNAME'],
            'message' => "Hello {$user}.",
        ];
    }
}
