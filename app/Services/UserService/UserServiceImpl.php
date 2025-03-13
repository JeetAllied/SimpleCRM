<?php
namespace App\Services\UserService;
//use App\Models\PasswordReset;
use App\Models\User;

class UserServiceImpl implements UserService {
    private $user, $passwordReset;
    public function __construct()
    {
        $this->user = New User();
        //$this->passwordReset = New PasswordReset();
    }
    public function getUserByEmail($email)
    {
        return $this->user->getUserByEmail($email);
    }

    public function updateUser($data, $id)
    {
        return $this->user->updateUser($data, $id);
    }

    public function getUserByTokenAndEmail($token, $email)
    {
        return $this->user->getUserByTokenAndEmail($token, $email);
    }

    public function getAllUsers()
    {
        return $this->user->getAllUsers();
    }

    public function addUser($data)
    {
        return $this->user->addUser($data);
    }

    public function findUserById($id)
    {
        return $this->user->findUserById($id);
    }

    public function deleteUser($id)
    {
        return $this->user->deleteUser($id);
    }

    public function updatePassword($data, $id)
    {
        return $this->user->updatePassword($data, $id);
    }

    public function getPasswordResetData($resetCode)
    {
        return $this->passwordReset->getPasswordResetData($resetCode);
    }

    public function resetPassword()
    {

    }
}
