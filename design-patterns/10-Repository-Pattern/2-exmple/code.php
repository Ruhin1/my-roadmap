
<?php

// ধাপ ১: Entity Class (User.php)


class User {
    public $id;
    public $name;
    public $email;

    public function __construct($id, $name, $email) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }
}

// ধাপ ২: Repository Interface (UserRepositoryInterface.php)

interface UserRepositoryInterface {
    public function getAllUsers();
    public function getUserById($id);
    public function createUser($user);
    public function deleteUser($id);
}

// ধাপ ৩: Repository Implementation (UserRepository.php)

class UserRepository implements UserRepositoryInterface {
    private $users = [];

    public function __construct() {
        // কিছু ডামি ডেটা যোগ করা হলো
        $this->users[] = new User(1, "Ruhin", "ruhin@gmail.com");
        $this->users[] = new User(2, "Tonmoy", "tonmoy@gmail.com");
    }

    public function getAllUsers() {
        return $this->users;
    }

    public function getUserById($id) {
        foreach ($this->users as $user) {
            if ($user->id == $id) {
                return $user;
            }
        }
        return null;
    }

    public function createUser($user) {
        $this->users[] = $user;
    }

    public function deleteUser($id) {
        $this->users = array_filter($this->users, function ($user) use ($id) {
            return $user->id != $id;
        });
    }
}

// ধাপ ৪: Controller (UserController.php)



class UserController {
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function showAllUsers() {
        $users = $this->userRepository->getAllUsers();
        foreach ($users as $user) {
            echo "ID: {$user->id}, Name: {$user->name}, Email: {$user->email}<br>";
        }
    }

    public function addUser($name, $email) {
        $newId = rand(100, 999); // নতুন ব্যবহারকারীর জন্য একটি র‍্যান্ডম আইডি তৈরি করা হলো
        $newUser = new User($newId, $name, $email);
        $this->userRepository->createUser($newUser);
        echo "User added successfully.<br>";
    }

    public function deleteUser($id) {
        $this->userRepository->deleteUser($id);
        echo "User deleted successfully.<br>";
    }
}

// ব্যবহার করার উদাহরণ
$repository = new UserRepository();
$controller = new UserController($repository);

// সমস্ত ব্যবহারকারী দেখানো
echo "All Users:\n";
$controller->showAllUsers();

// নতুন ব্যবহারকারী যোগ করা
echo "\nAdding a New User:\n";
$controller->addUser("Maruf", "maruf@gmail.com");

// সমস্ত ব্যবহারকারী দেখানো
echo "\nAll Users After Adding:\n";
$controller->showAllUsers();

// ব্যবহারকারী মুছে ফেলা
echo "\nDeleting User with ID 1:\n";
$controller->deleteUser(1);

// সমস্ত ব্যবহারকারী দেখানো
echo "\nAll Users After Deletion:\n";
$controller->showAllUsers();



