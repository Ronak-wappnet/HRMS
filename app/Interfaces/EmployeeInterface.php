<?php

namespace App\Interfaces;

interface EmployeeInterface
{
    function listEmployee();
    function add($data);
    function edit($request,$user);
    function find($id);
    function delete($id);
}

?>