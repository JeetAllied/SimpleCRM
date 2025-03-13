<?php
namespace App\Services\UserService;
interface UserService{
    public function getUserByEmail($email);
    public function updateUser($data, $id);
    public function getUserByTokenAndEmail($token, $email);
    public function getAllUsers();
    public function addUser($data);
    public function findUserById($id);
    public function deleteUser($id);
    public function updatePassword($data, $id);
    public function getPasswordResetData($resetCode);
    public function resetPassword();
}
