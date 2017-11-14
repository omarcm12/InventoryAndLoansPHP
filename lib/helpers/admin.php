<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

class AdminHelpers {
  private $sidebar;

  public function SetSidebar($sidebar) {
    $this->sidebar = $sidebar;
  }

  public function Sidebar() {
    return $this->sidebar;
  }
}

function adminCurrentUser() {
  global $BASE;

  return $BASE->Session()->CurrentUser();
}

?>
