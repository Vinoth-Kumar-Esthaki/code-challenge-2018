<?php
class Utils{

  public static function stdin_stream(){
    do{
      $command = trim(fgets(STDIN));
      $inputs[] = explode(" ",$command);
    }while(strtoupper($command) != 'END');
    return $inputs;
  }
  /**
   * app document
   *
   * method to output the app documentation
   *
   * @return return string
   */
  public static function appDoc(){
    $docText =
<<<DOC
      **************************************************************
      *                   Code Challenge                           *
      **************************************************************
      The app accepts the following commands :

      SET [name][value]
        Set a variable [name] to the value [value].
        Neither variable names nor values will ever contain spaces.

      GET [name]
        Print out the value stored under the variable [name].
        Print NULL if that variable name hasn't been set.

      UNSET [name]
        Unset the variable [name]

      NUMEQUALTO [value]
        Return the number of variables equal to [value].
        If no values are equal, this should output 0.

      END
        Exit the program.

      BEGIN
        Open a transactional block.

      ROLLBACK
        Rollback all of the commands from the most recent transcational block.

      COMMIT
        Permanently store all of the operations from all presently open transactional block.

DOC;
    return $docText;

  }
  /**
   * execute commands
   * function to execute the commands passed
   * through the stdin
   *
   * @param array commands
   * @param object database
   * @return return boolean
   */
  public static function executeCommands($commands,$database)
  {
    try{
      foreach($commands as $idx=>$command){
        $userCmd = $command[0] ?? "";
        $name = $command[1] ?? "";
        $value = $command[2] ?? null;

        if(!empty($userCmd)){
            switch (strtoupper($userCmd)) {
              case 'SET':
                $database->set($name,$value);
                break;
              case 'GET':
                echo $database->get($name)."\n";
                break;
              case 'UNSET':
                $database->deleteValue($name);
                break;
              case 'NUMEQUALTO':
                echo $database->frequency($name)."\n";
                break;
              case 'BEGIN':
                $database->begin();
                break;
              case 'ROLLBACK':
                $database->rollback();
                break;
              case 'COMMIT':
                $database->commit();
                break;
              case 'END':
                exit();
                break;
              default:
                fwrite(STDOUT, "Invalid Command ! \n");
                exit();
                break;
            }
        }else{
            throw new \Exception("Command block cannot be empty !");
        }
      }
    }catch(Exception $e){
      fwrite(STDIN,$e->getMessage()."\n");
    }
  }

}

 ?>
