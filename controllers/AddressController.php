<?php

class AddressController {
    public function createAddress($streetNo, $streetName, $ward, $district, $province) {
        $address = new Address();
        $address->setStreetNo($streetNo);
        $address->setStreetName($streetName);
        $address->setWard($ward);
        $address->setDistrict($district);
        $address->setProvince($province);
        $result = $address->createAddress();
        
        return $result;
    }

    public function getAddress($addressId) {
        $address = new Address();
        $address->getAddress($addressId);
        return $address;
    }

    // update address
    public function updateAddress($address_id, $streetNo, $streetName, $ward, $district, $province) {
        $address = new Address();
        $address->setAddressId($address_id);
        $address->setStreetNo($streetNo);
        $address->setStreetName($streetName);
        $address->setWard($ward);
        $address->setDistrict($district);
        $address->setProvince($province);
        $address->updateAddress(
            $address_id,
            $streetNo,
            $streetName,
            $ward,
            $district,
            $province
        );
    }
}