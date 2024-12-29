<?php

class EmailNotification implements Listener {
    public function handle($data) {
        echo "Sending Email to {$data['email']} with subject: '{$data['subject']}' <br/>";
    }
}
