<?php
class Test {
	private function isOK() {
		return false;
	}

	public function printStatus() {
		var_dump($this->isOK());
	}
}
$a = new Test();
$a->printStatus();