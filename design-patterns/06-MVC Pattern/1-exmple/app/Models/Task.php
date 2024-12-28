<?php

namespace App\Models;

class Task {
    // স্ট্যাটিক অ্যারে টাস্ক সংরক্ষণের জন্য (ঐচ্ছিক)
    // private static $tasks = [];

    public static function addTask($task) {
        // লাস্ট কী বের করা, যদি কুকি খালি না থাকে
        $lastKey = empty($_COOKIE) ? 1 : array_key_last($_COOKIE);
        $key = $lastKey + 1; // নতুন কী
        setcookie($key, $task, time() + 3600); // কুকি ১ ঘন্টার জন্য সেভ

        // (ঐচ্ছিক) টাস্ক অ্যারেতে সংরক্ষণ
        // self::$tasks[] = $task;
    }

    public static function getAllTasks() {
        // যদি কুকি খালি না থাকে, তাহলে সেটি ফেরত দেয়
        return !empty($_COOKIE) ? $_COOKIE : [];

        // (ঐচ্ছিক) স্ট্যাটিক অ্যারেতে সংরক্ষণ করা টাস্ক ফেরত
        // return self::$tasks;
    }

    public static function deleteAll() {
        // সমস্ত কুকি লুপ করে মুছে ফেলা
        foreach ($_COOKIE as $key => $value) {
            // কুকি মুছে ফেলার জন্য সেটকুকি ব্যবহার
            setcookie($key, '', time() - 3600, '/'); // '/' ডিরেক্টরি পুরো ডোমেইনের জন্য কুকি মুছে দেবে
        }
    }
    
}
