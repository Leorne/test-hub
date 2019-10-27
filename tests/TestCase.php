<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    function signIn($user = null){
        $user = $user ? $user : create('App\User');
        return $this->actingAs($user);
    }
}
