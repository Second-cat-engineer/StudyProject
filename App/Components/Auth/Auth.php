<?php

namespace App\Components\Auth;

use App\Exceptions\IdentityException;
use App\Exceptions\MultiException;
use App\Models\User;

class Auth
{
    const ERROR_INVALID_LOGIN = 401;
    const ERROR_INVALID_PASSWORD = 401;
    const MIN_LENGTH_LOGIN = 3;
    const MIN_LENGTH_PASSWORD = 3;
    const DEFAULT_USER_ACCESS = 'user';

    public function getCurrentUser()
    {
        return UserSession::issetSession();
    }

    protected function login($login)
    {
        return UserSession::startSession($login);
    }

    public function logout()
    {
        return UserSession::unsetSession();
    }

    protected function existUser($login)
    {
        return User::findByLogin($login);
    }

    protected function checkPassword($login, $password) : bool
    {
        if (!$this->existUser($login)) {
            return false;
        }
        $hashPassword = $this->existUser($login)->passwordHash;
        return password_verify($password, $hashPassword);
    }

    public function authenticate(array $data)
    {
        $login = $data['login'];
        $password = $data['password'];

        $errors = new MultiException();

        if (empty($login)) {
            $errors->add(new IdentityException('Вы не ввели Логин!', self::ERROR_INVALID_LOGIN));
        } elseif (!$this->existUser($login)) {
            $errors->add(new IdentityException('Пользователь с таким логином не существует', self::ERROR_INVALID_LOGIN));
        }

        if (empty($password)) {
            $errors->add(new IdentityException('Вы не ввели Пароль!', self::ERROR_INVALID_PASSWORD));
        } elseif (!$this->checkPassword($login, $password)) {
            $errors->add(new IdentityException('Пароль введен неправильно', self::ERROR_INVALID_PASSWORD));
        }
        if (!$errors->isEmpty()) {
            throw $errors;
        }

        return $this->login($login);
    }

    public function registration($data)
    {
        $login = $data['login'];
        $password = $data['password'];

        $errors = new MultiException();

        if (empty($login)) {
            $errors->add(new IdentityException('Вы не ввели Логин!', self::ERROR_INVALID_LOGIN));
        }  elseif (strlen($login) < self::MIN_LENGTH_LOGIN) {
            $errors->add(new IdentityException('Логин слишком короткий!', self::ERROR_INVALID_LOGIN));
        } elseif ($this->existUser($login)) {
            $errors->add(new IdentityException('Пользователь с таким логином уже зарегестрирован', self::ERROR_INVALID_LOGIN));
        }

        if (empty($password)) {
            $errors->add(new IdentityException('Вы не ввели Пароль!', self::ERROR_INVALID_PASSWORD));
        } elseif (strlen($password) < self::MIN_LENGTH_PASSWORD) {
            $errors->add(new IdentityException('Пароль слишком короткий!', self::ERROR_INVALID_PASSWORD));
        }

        if (!$errors->isEmpty()) {
            throw $errors;
        }

        echo password_hash($password, PASSWORD_DEFAULT);
        $user = new User();
        $user->login = $login;
        $user->passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $user->access = self::DEFAULT_USER_ACCESS;
        $user->save();

        $this->login($user->login);
    }
}