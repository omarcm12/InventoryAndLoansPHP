<?php

class DBResults implements ArrayAccess, Countable, Iterator {
  protected $page_current = 0;
  protected $page_max = 0;
  protected $page_per = 0;

  protected $results = array();
  protected $results_count = 0;
  protected $results_total = 0;

  public function __construct($results, $page, $per) {
    $page = intval($page);
    $per = intval($per);

    $this->page_current = ($page < 1) ? 1 : $page;
    $this->page_per = ($per < 0) ? 0 : $per;

    if (!empty($results)) {
      $this->results = $results;
      $this->results_count = count($this->results);
      $this->SetResultsTotal($this->results_count);
    }
  }

  public function FirstPage() {
    return 1;
  }

  public function GetResults() {
    return $this->results;
  }

  public function LastPage() {
    return $this->page_max;
  }

  public function NextPage() {
    $next = $this->page_current + 1;
    if ($next > $this->page_max) { $next = $this->page_max; }
    return $next;
  }

  public function Page() {
    return $this->page_current;
  }

  public function PaginationEnd() {
    $paginate = $this->Page() + 2;
    if ($paginate > $this->LastPage()) { $paginate = $this->LastPage(); }
    return $paginate;
  }

  public function PaginationStart() {
    $paginate = $this->Page() - 2;
    if ($paginate < 1) { $paginate = 1; }
    return $paginate;
  }

  public function PrevPage() {
    $prev = $this->page_current - 1;
    if ($prev < 1) { $prev = 1; }
    return $prev;
  }

  public function SetResultsTotal($total) {
    $total = intval($total);
    if ($total < 0) { $total = 0; }
    $this->results_total = $total;          
    $this->page_max = ($this->page_per == 0) ? 1 : intval(ceil($this->results_total / $this->page_per));
  }

  /* COUNTABLE */
  public function count() {
    return $this->results_count;
  }

  /* ITERATOR */
  public function current() {
    return current($this->results);
  }

  public function GetResultsTotal(){
    return $this->results_total;
  }

  public function key() {
    return key($this->results);
  }

  public function next() {
    return next($this->results);
  }

  public function rewind() {
    return reset($this->results);
  }

  public function valid() {
    return key($this->results) !== null;
  }

  /* ARRAYACCESS */
  public function offsetExists($index) {
    return array_key_exists($index, $this->results);
  }

  public function offsetGet($index) {
    if ($this->offsetExists($index)) {
      return $this->results[$index];
    }
    return null;
  }

  public function offsetSet($index, $value) {
    if ($index) {
      $this->results[$index] = $value;
    } else {
      $this->results[] = $value;
    }
    return true;

  }

  public function offsetUnset($index) {
    unset($this->results[$index]);
    return true;
  }
}

?>
