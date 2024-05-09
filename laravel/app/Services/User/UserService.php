<?php

namespace App\Services\User;

use http\Env\Request;

class UserService
{
    public function index(Request $request)
    {
        $UserDataset = new UserDataset();
        $UserDataset->contact_address = $request->post('contact_address');
        $UserDataset->register_address = $request->post('register_address');
        $UserDataset->contact_phone = $request->post('contact_phone');
        $UserDataset->passport_serial = $request->post('passport_serial');
        $UserDataset->passport_number = $request->post('passport_number');
        $UserDataset->passport_address_from = $request->post('passport_address_from');
        $UserDataset->passport_from_date = $request->post('passport_from_date');
        $UserDataset->passport_cod_department = $request->post('passport_cod_department');
        $UserDataset->passport_birthday = $request->post('passport_birthday');
        $UserDataset->city_birthday = $request->post('city_birthday');
        $UserDataset->INN = $request->post('INN');
        $UserDataset->SNILS = $request->post('SNILS');
        $UserDataset->save();

        return 'worked!';
    }
}
