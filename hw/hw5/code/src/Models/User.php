<?php

namespace Geekbrains\Application1\Models;

use Geekbrains\Application1\Application;

class User {

    private ?string $userName;
    private ?int $userBirthday;

    private static string $storageAddress = '/storage/birthdays.txt';

    public function __construct(string $name = null, int $birthday = null){
        $this->userName = $name;
        $this->userBirthday = $birthday;
    }

    public function setName(string $userName) : void {
        $this->userName = $userName;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getUserBirthday(): int {
        return $this->userBirthday;
    }

    public function setBirthdayFromString(string $birthdayString) : void {
        $this->userBirthday = strtotime($birthdayString);
    }

    public static function getAllUsersFromStorage(): array|false {
        $address = $_SERVER['DOCUMENT_ROOT'] . User::$storageAddress;
        
        if (file_exists($address) && is_readable($address)) {
            $file = fopen($address, "r");
            
            $users = [];
        
            while (!feof($file)) {
                $userString = fgets($file);
                $userArray = explode(",", $userString);

                $user = new User(
                    $userArray[0]
                );
                $user->setBirthdayFromString($userArray[1]);

                $users[] = $user;
            }
            
            fclose($file);

            return $users;
        }
        else {
            return false;
        }
    }

    public function addUser(array $userGET): bool
    {
        $address = $_SERVER['DOCUMENT_ROOT'] . Application::config()['storage']['address'];

        $data = PHP_EOL . $userGET['name'] . ", " . $userGET['birthday'];

        $fileHandler = fopen($address, 'a');

        return fwrite($fileHandler, $data);
    }
}