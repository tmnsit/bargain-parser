<?php

namespace App\Dto;


class LotDto{

    public string $name = '';

    public string $hashName = '';

    public string $infoProperty = '';

    public string $familiarization = '';

    public string $classification = '';

    public string $startPrice = '';

    public string $deposit = '';

    public string $increaseAmount = '';

    public string $status = '';

    public array $files = [];


    public static function createFromParseArray($props) :self
    {
        $lot = new self();
        if(key_exists('Предмет торгов', $props)){
            $lot->name = trim($props['Предмет торгов']);
            $lot->hashName = md5($props['Предмет торгов']);
        }

        if(key_exists('name', $props)){
            $lot->name = trim($props['name']);
            $lot->hashName = md5($props['name']);
        }

        if(key_exists('Cведения об имуществе (предприятии) должника, выставляемом на торги, его составе, характеристиках, описание', $props)){
            $lot->familiarization = trim($props['Cведения об имуществе (предприятии) должника, выставляемом на торги, его составе, характеристиках, описание']);
        }

        if(key_exists('Порядок ознакомления с имуществом (предприятием) должника', $props)){
            $lot->infoProperty = $props['Порядок ознакомления с имуществом (предприятием) должника'];
        }

        if(key_exists('Классификатор имущества', $props)){
            $lot->classification = $props['Классификатор имущества'];
        }

        if(key_exists('Начальная цена продажи имущества', $props)){
            $lot->startPrice = $props['Начальная цена продажи имущества'];
        }

        if(key_exists('Величина повышения начальной цены', $props)){
            $lot->increaseAmount = $props['Величина повышения начальной цены'];
        }

        if(key_exists('Размер задатка', $props)){
            $lot->deposit= $props['Размер задатка'];
        }

        if(key_exists('Статус торгов', $props)){
            $lot->status = $props['Статус торгов'];
        }

        $lot->files = key_exists('files', $props) ?  $props['files'] : [];

        return $lot;
    }
}
