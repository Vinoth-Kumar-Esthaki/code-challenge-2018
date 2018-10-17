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
  protected $transactions = array();
  /**
   * value frequency/count
   *
   * @var array
   */
  protected $valueFrequency =array();

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
    // record this changes in $transactions
    $this->recordChanges($name);
    //  create an entry in $storage
    $this->storeValue($name,$value);

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
    if ($this->transactions) {
      //get the recentEntry
      $recentTransaction = end($this->transactions);
      if (!isset($recentTransaction[$name])) {
        $this->transactions[key($this->transactions)][$name] = $this->get($name);
      }
    }
  }
  /**
   * Set value
   *
   * @param $name
   * @param bool $value
   */
  public function storeValue($name,$value=false)
  {

    //if exist already remove & update the new value
    $this->remove($name);

    if ($value) {
      $this->storage[$name] = $value;
      $this->valueFrequency[$value] = isset($this->valueFrequency[$value]) ? $this->valueFrequency[$value] + 1 : 1;
    }
  }
  /**
   * remove the value
   *
   * @param $name
   */
  public function remove($name)
  {
    if(isset($this->storage[$name])) {
      //decrement the counter
      $this->valueFrequency[$this->storage[$name]] -= 1;
      //remove the value
      unset($this->storage[$name]);
    }
  }
  /**
   * unset the variable
   *
   * method to unset the name from
   *
   * @param $name
   */
  public function deleteValue($name)
  {
    $this->recordChanges($name);
    $this->remove($name);
  }

  /**
   * Frequency of occurance
   *
   * Method to return the Frequency of the number in the storage
   *
   * @param $value
   * @return int
   */
  public function frequency($value)
  {
    return $this->valueFrequency[$value] ?? 0;
  }
  /**
   * begin transactions
   *
   * starts a new transcations block
   */
  public function begin()
  {
    array_push($this->transactions, array());
  }

  /**
   * commit all operations in the recent transcations block to $storage
   */
  public function commit()
  {
    $this->transactions = array();
  }

  /**
   * rollback all operations in the recent transactions block
   */
  public function rollback()
  {
    if ($this->transactions) {
      //get the recent entry in the transactions block
      $recentEntry = end($this->transactions);
      foreach($recentEntry as $name => $value) {
        $this->storeValue($name,$value);
      }
      unset($this->transactions[key($this->transactions)]);
    }else{
      throw new Exception("NO TRANSCATION");

    }
  }
}
 ?>
