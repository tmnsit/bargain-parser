<?php

namespace App\Dto;

class OrganizerDto{
    public string $name = '';
    public string $email = '';
    public string $phone = '';


    public static function fromParseArray($props) : self
    {
        $organizer = new self();

        $organizer->name = key_exists('Наименование', $props) ? trim($props['Наименование']) : '';
        $organizer->email = key_exists('Адрес электронной почты', $props) ? trim($props['Адрес электронной почты']) : '';
        $organizer->phone = key_exists('Номер контактного телефона', $props) ? trim($props['Номер контактного телефона']) : '';

        return $organizer;
    }

}
