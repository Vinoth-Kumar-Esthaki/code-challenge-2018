<?php
/**
* Memory Database Class
**/
class MemoryDatabase{
  /**
   * database storage
   *
   * @var array
   */
  protected $storage = array();
  /**
   * transactions history
   *
   * @var array
   */
  var $transactions = array();

  /**
   * get the stored value
   *
   * method to fetch the value stored under the specific name
   *
   * @param $name string
   * @return string
   */
  public function get($name)
  {
    return $this->storage[$name] ?? 'null';
  }
  /**
   * set the stored value
   *
   * method to set the value in storage under specific name
   * maintain  & track changes
   *
   * @param $name string
   * @return $value numerals
   */
  public function set($name,$value)
  {
    //  create an entry in $storage
    $this->storeValue($name,$value);
    // record this changes in $transactions
    $this->recordChanges($name);

  }
  /**
   * records changes
   *
   * Keeps track on value changes in storage
   *
   * @param $name string
   */
  public function recordChanges($name)
  {
    if(isset($this->transactions)){
      //get the most recent entry
      //move the pointer to the recent entry
      $lastEntry = end($this->transactions);
      if(!isset($lastEntry[$name])){
        //get the key of the current pointer
        $key = key($this->transactions);
        $this->transactions[$key][$name] = $this->get($name);
      }
    }
    print_r($this->transactions);
  }
  /**
   * Set value
   *
   * @param $name
   * @param bool $value
   */
  protected function storeValue($name,$value=false)
  {
    if ($value) {
      //echo 124;
      $this->storage[$name] = $value;
      //$this->valueUsage[$value] = isset($this->valueUsage[$value]) ? $this->valueUsage[$value] + 1 : 1;
    }
  }



}
 ?>
