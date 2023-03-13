<?php

namespace App\Dto;

class BargainDto{

    public int $extId;
    public string $number;


    public ?OrganizerDto $organizer;

    public ?MangerDto $manager;

    public ?DebtorDto $debtor;

    public array $files;

    public array $lots = [];


    public static function fromParseArray($props)
    {
        $bargain = new self();

        $bargain->number = $props['number'];

        $bargain->extId = $props['extId'];

        if(key_exists('Сведения о должнике', $props)){
            $bargain->debtor = DebtorDto::fromParseArray($props['Сведения о должнике']);
        }

        if(key_exists('Арбитражный управляющий', $props)){
            $bargain->manager = MangerDto::fromParseArray($props['Арбитражный управляющий']);
        }

        if(key_exists('Организатор торгов', $props)){
            $bargain->organizer = OrganizerDto::fromParseArray($props['Организатор торгов']);
        }

        $bargain->files = key_exists('files', $props) ?  $props['files'] : [];

        if(key_exists('lots', $props)){
            foreach ($props['lots'] as $lot){
                $bargain->addLot(LotDto::createFromParseArray($lot));
            }
        }

        return $bargain;
    }


    public function addLot(LotDto $lot){
        $this->lots[] = $lot;
    }


}
