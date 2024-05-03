<?php

class EducationController {
    // create education
    public function createEducation($user_id, $degree_name, $institution_name, $start_year, $end_year) {
        $education = new Education();
        $result = $education->createEducation($user_id, $degree_name, $institution_name, $start_year, $end_year);
        return $result;
    }

    // delete education
    public function deleteEducation($education_id) {
        $education = new Education();
        $result = $education->deleteEducation($education_id);
        return $result;
    }

    // get education by user id
    public function getEducationByUserId($user_id) {
        $education = new Education();
        $result = $education->getEducationByUserId($user_id);
        return $result;
    }

    // 
}