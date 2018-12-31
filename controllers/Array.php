<?php
class ArrayController extends Controller {

    public function __construct() {
    }

    public function index() {
    }

    public function byteArray() {
		$location = "abc                        ";

		p('The string: ' . $location);
		$this->dumpMemory($location, strlen($location));
//		putInteger(0, 1456788333);
//		putInteger(4, 255);
//		putInteger(8, 65535);

//		echo microtime() . "\n";

//		for ($i = 0; $i < 80000; $i += 4) {
//			$this->putInteger($i, 0);
//		}
//		echo microtime() . "\n";
//		$this->dumpMemory($location, 100);
    }

	/**
	 * @param $location
	 * @param $count
	 */
	private function dumpMemory($location, $count) {
		echo '<pre>';
		for ($i = 0; $i < $count; $i++) {
			printf("%02x ", ord($location[$i]));
		}
		echo '</pre>';
	}

	/**
	 * @param $offset
	 * @param $value
	 */
	private function putInteger($offset, $value) {
		global $location;

		$d = $value & 0x000000ff;
		$c = ($value & 0x0000ff00) >> 8;
		$b = ($value & 0x00ff0000) >> 16;
		$a = ($value & 0xff000000) >> 24;

		$location[$offset]     = chr($a);
		$location[$offset + 1] = chr($b);
		$location[$offset + 2] = chr($c);
		$location[$offset + 3] = chr($d);
	}
}