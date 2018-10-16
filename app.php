<?php
require_once 'includes/classes/utils.php';
//app doc
fwrite(STDOUT,"\n".Utils::appDoc()."\n");
// read input stream from STDIN
$commands = Utils::stdin_stream();
// start output
fwrite(STDOUT,"\nOutput\n");
//execute the commands
if(count($commands) > 0){
  Utils::executeCommands($commands);
}

?>
