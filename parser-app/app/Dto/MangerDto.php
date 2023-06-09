<?php

namespace App\Dto;

class MangerDto{
    public string $name = '';
    public string $nameCompany = '';
    public string $fsr = '';


    public static function fromParseArray($props)
    {
        $manager = new self();
        $manager->name = key_exists('Фамилия, имя, отчество', $props) ? trim($props['Фамилия, имя, отчество']) : '';
        $manager->nameCompany = key_exists('Название саморегулируемой организации арбитражных управляющих', $props) ? trim($props['Название саморегулируемой организации арбитражных управляющих']) : '';
        $manager->fsr = key_exists('Регистрационный номер ФРС', $props) ? trim($props['Регистрационный номер ФРС']) : '';


        return $manager;
    }
}
