<?php

namespace App\Interfaces;

interface UserInterface 
{
    public function register($data);
    public function forgotPassword($request);
    public function resetPassword($request);   

    public function edit($request);
    public function changePassword($request);
}
?>