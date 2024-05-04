<?php

class CertificateController {
    // create certificate
    public function createCertificate($user_id, $certificate_name, $issuer, $year_issued, $link) {
        $certificate = new Certificate();
        $result = $certificate->createCertificate($user_id, $certificate_name, $issuer, $year_issued, $link);
        return $result;
    }

    // get certificate by user id
    public function getCertificatesByUserId($user_id) {
        $certificate = new Certificate();
        $result = $certificate->getCertificatesByUserId($user_id);
        return $result;
    }

    // delete certificate
    public function deleteCertificate($certificate_id) {
        $certificate = new Certificate();
        $result = $certificate->deleteCertificate($certificate_id);
        return $result;
    }
}