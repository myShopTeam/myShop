<?php
file_put_contents('data/log/' . '2017-03-06.log', date('Y-m-d H:i:s',time()) . "  测试:" . print_r(array('a' => 1),1).PHP_EOL.PHP_EOL,FILE_APPEND);
file_put_contents('data/log/' . '2017-03-06.log', date('Y-m-d H:i:s',time()) . "  测试:" . print_r($_GET,1).PHP_EOL.PHP_EOL,FILE_APPEND);
file_put_contents('data/log/' . '2017-03-06.log', date('Y-m-d H:i:s',time()) . "  测试:" . print_r($_POST,1).PHP_EOL.PHP_EOL,FILE_APPEND);
file_put_contents('data/log/' . '2017-03-06.log', date('Y-m-d H:i:s',time()) . "  测试:" . print_r($_REQUEST,1).PHP_EOL.PHP_EOL,FILE_APPEND);
file_put_contents('data/log/' . '2017-03-06.log', date('Y-m-d H:i:s',time()) . "  测试:" . print_r(file_get_contents('php://input'),1).PHP_EOL.PHP_EOL,FILE_APPEND);