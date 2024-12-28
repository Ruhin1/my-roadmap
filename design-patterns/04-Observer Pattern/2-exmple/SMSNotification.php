<?php

class SMSNotification implements Listener {
    public function handle($data) {
        echo "Sending SMS to {$data['phone']} with message: '{$data['message']}'<br/>";
    }
}
