<?php
require_once '../../AnalogHelper.php';

abstract class UnitTest extends PHPUnit_Framework_TestCase
{

    public function index()
    {
        $timeStamp = new AnalogHelper();
        AnalogHelper::log('test');
    }
}
