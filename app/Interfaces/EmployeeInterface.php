<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\TextUI\Configuration\Variable;

/**
 * Employee Interface 
 */
interface EmployeeInterface
{
    function listEmployee();
    function add($data) ;
    function edit($request,$user);
    function find($id);
    function delete($id);
}

?>