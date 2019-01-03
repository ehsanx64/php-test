<?php
use Dotenv\Dotenv;

class DotEnvController extends Controller {

    public function __construct() {
    }

    public function index() {
        $dotenv = new Dotenv(__DIR__);
        $dotenv->safeLoad();

        d($_ENV);
        p('Username is: ' . getenv('Username'));
    }
}
