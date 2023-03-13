<?php

namespace App\Dto;

class OrganizerDto{
    public string $name = '';
    public string $email = '';
    public string $phone = '';


    public static function fromParseArray($props) : self
    {
        $organizer = new self();

        $organizer->name = key_exists('Наименование', $props) ? $props['Наименование'] : '';
        $organizer->email = key_exists('Адрес электронной почты', $props) ? $props['Адрес электронной почты'] : '';
        $organizer->phone = key_exists('Номер контактного телефона', $props) ? $props['Номер контактного телефона'] : '';

        return $organizer;
    }

}
