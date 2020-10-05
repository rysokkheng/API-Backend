<?php
/**
 * Created by PhpStorm.
 * User: mruongyutthy
 * Date: 1/4/20
 * Time: 14:46
 */

namespace App\Contracts\Services;

interface LoginServiceInterface
{
    public function login($username, $password);
}