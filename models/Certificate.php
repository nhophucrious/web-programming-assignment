<?php

class Certificate {
    private $db;
    private $certificate_id;
    private $user_id; // fk to users table
    private $certificate_name;
    private $issuer;
    private $year_issued;
    private $link; // link to the certificate for verification

    public function __construct() {
        $this->db = new Database();
    }

    // getters and setters
    public function getCertificateId() {
        return $this->certificate_id;
    }

    public function setCertificateId($certificate_id) {
        $this->certificate_id = $certificate_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getCertificateName() {
        return $this->certificate_name;
    }

    public function setCertificateName($certificate_name) {
        $this->certificate_name = $certificate_name;
    }

    public function getIssuer() {
        return $this->issuer;
    }

    public function setIssuer($issuer) {
        $this->issuer = $issuer;
    }

    public function getYearIssued() {
        return $this->year_issued;
    }

    public function setYearIssued($year_issued) {
        $this->year_issued = $year_issued;
    }

    public function getLink() {
        return $this->link;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    // create certificate
    public function createCertificate($user_id, $certificate_name, $issuer, $year_issued, $link) {
        $conn = $this->db->getConnection();
        $sql = "INSERT INTO certificate (user_id, certificate_name, issuer, year_issued, link) VALUES (:user_id, :certificate_name, :issuer, :year_issued, :link)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':certificate_name', $certificate_name);
        $stmt->bindParam(':issuer', $issuer);
        $stmt->bindParam(':year_issued', $year_issued);
        $stmt->bindParam(':link', $link);
        $stmt->execute();
        $this->db->closeConnection();
    }

    public function getCertificatesByUserId($user_id) {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM certificate WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $certificates = $stmt->fetchAll();
        $this->db->closeConnection();
        return $certificates;
    }

    // delete certificate
    public function deleteCertificate($certificate_id) {
        $conn = $this->db->getConnection();
        $sql = "DELETE FROM certificate WHERE certificate_id = :certificate_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':certificate_id', $certificate_id);
        $stmt->execute();
        $this->db->closeConnection();
    }
}