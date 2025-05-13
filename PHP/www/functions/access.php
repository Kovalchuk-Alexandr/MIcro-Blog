<?php
  
  function is_admin(){
    // Если есть пользователь и он 'admin' - значит ОК
    if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
        return true;
    }
    
    return false;
  }