<?php
use ehsanx64\phplib\Module;
use ehsanx64\phplib\General\Date;

class PhplibController extends Controller {

    public function __construct() {
    }

    public function index() {
        // Is 123 similar to a date?
        $r = Date::isDateString('123');
        var_dump($r);

        // What about 2018-01-03?
        $r = Date::isDateString('2018-01-03');
        var_dump($r);
    }

    public function testModule() {
        $m = new Module(__DIR__ . '/phplib_mods');
    }
}
