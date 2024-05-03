<?php

class ExpController {
    // create experience
    public function createExp($exp_name, $year_start, $year_end, $exp_description, $user_id) {
        $exp = new Exp();
        $result = $exp->createExp($exp_name, $year_start, $year_end, $exp_description, $user_id);
        return $result;
    }

    // delete experience
    public function deleteExp($exp_id) {
        $exp = new Exp();
        $result = $exp->deleteExp($exp_id);
        return $result;
    }

    // get all experience by user id
    public function getExpByUserId($user_id) {
        $exp = new Exp();
        $result = $exp->getExpByUserId($user_id);
        return $result;
    }

}