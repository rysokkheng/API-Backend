<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Traits\Transformable;

/**
 * Created by PhpStorm.
 * User: rysokkheng
 * Date: 1/15/2020
 * Time: 09:19
 */

class BaseController extends Controller
{
    use Transformable;
}
