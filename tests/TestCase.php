<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function admin()
    {
        $admin = factory('App\User')->create();

        $admin->admin = true;

        $admin->save();

        return $admin;
    }
}
