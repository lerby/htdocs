<?php

class workerThread extends Thread {
    public function run(){
        // DO SOME BIG STUFF
    }
}

$workers = array();
for ($i = 0; $i < 1000; ++$i) {
    $workers[] = new workerThread();
    $workers[count($workers) - 1]->start();
}

foreach ($workers as $worker) {
    $worker->join();
}