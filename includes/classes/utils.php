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
        if(!empty($userCmd)){
            switch (strtoupper($userCmd)) {
              case 'SET':
                // code...
                break;
              case 'GET':
                  // code...
                break;
              case 'UNSET':
                    // code...
                break;

              default:
                // code...
                break;
            }
        }else{
            throw new \Exception("Command block cannot be empty !", 1);

        }
      }

    }catch(Exception $e){
      fwrite(STDIN,$e->getMessage());
    }
  }

}

 ?>
