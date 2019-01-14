<?php
use ehsanx64\phplib;
use ehsanx64\phplib\Date;
use ehsanx64\phplib\Module;
use ehsanx64\phplib\Translate;
use ehsanx64\phplib\Environment;

class PhplibController extends Controller {

    public function __construct() {
    }

    public function index() {
        // Is 123 similar to a date?
        $r = Date::isDateString('123');
        d($r);

        // What about 2018-01-03?
        $r = Date::isDateString('2018-01-03');
        d($r);
    }

    public function testModule() {
        $m = new Module(__DIR__ . '/phplib_mods');
    }

    public function testTranslate() {
        $t = new Translate(dirname(__FILE__) . '/lang');
        echo $t->t('Hello');

        $t->setLocale('fa');
        echo $t->trn('You have %s messages with %s unread', 2, 1);
//        echo sprintf($t->t('You have %s messages with %s unread'), 2, 1);
    }

    public function testEnvironment() {
        $e = new Environment();

		// Following line causes exception
//		$e->is('hello');

		// Following must be false
		p('Is WordPress? ' . ($e->is('wordpress') ? 'Yes' : 'No'));
    }
}
