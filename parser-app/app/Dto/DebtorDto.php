<?php

namespace App\Dto;

class DebtorDto{


    public string $fullName;
    public string $fio;
    public string $smallName;
    public string $ogrn;
    public string $inn;


    public static function fromParseArray($props) : self
    {
        $debtor = new self();

        if(key_exists('Фамилия, имя, отчество', $props)){
            $debtor->fio= $props['Фамилия, имя, отчество'];
        }

        if(key_exists('Полное наименование', $props) ){
            $debtor->fullName = $props['Полное наименование'];
        }

        if(key_exists('Краткое наименование', $props)){
            $debtor->smallName = $props['Краткое наименование'];
        }

        if(key_exists('СНИЛС', $props) ){
            $debtor->ogrn = $props['СНИЛС'];
        }

        if( key_exists('ИНН', $props) ){
            $debtor->inn = $props['ИНН'];
        }

        return $debtor;
    }


}
