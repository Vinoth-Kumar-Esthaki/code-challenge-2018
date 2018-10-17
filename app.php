<?php
require_once 'includes/classes/utils.php';
require_once 'includes/classes/MemoryDatabase.php';
//app doc
fwrite(STDOUT,"\n".Utils::appDoc()."\n");
fwrite(STDOUT,"\n Input : \n");
// read input stream from STDIN
$commands = Utils::stdin_stream();
// start output
fwrite(STDOUT,"\n Output : \n");
//execute the commands
if(count($commands) > 0){
  //instantiation
  $database = new MemoryDatabase();
  Utils::executeCommands($commands,$database);
}

?>
