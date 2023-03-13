<?php

namespace App\Services;

use App\Dto\BargainDto;
use App\Models\Bargain;
use DiDom\Document;

class ParseBargainService
{
    public function __construct(
        private FetchBargainService $fetchBargainService
    )
    {
    }

    public function handle()
    {
        $bargains = $this->parsePage(1);


        dd($bargains);
        return [];
    }

    public function parsePage(int $pageNum) : array
    {
        $htmlList = $this->fetchBargainService->fetchHtmlList($pageNum);

        $bargains = $this->parseList($htmlList);
        $bargainsPageArr = [];
        foreach ($bargains['bargains'] as $bargain){
            if (!$bargain['id'] || !$bargain['number']) {
                info('id или номер торга не найден: ' . json_encode($bargain, JSON_UNESCAPED_UNICODE));
                continue;
            }

            $htmlDetail = $this->fetchBargainService->fetchHtmlDetailForId($bargain['id']);
            $bargainsPageArr[] = $this->parseDetail($htmlDetail, $bargain['id'], $bargain['number']);
        }

        return $bargainsPageArr;
    }

    public function parseList($html): array
    {
        $documentList = new Document($html, false, 'windows-1251');
        $table = $documentList->first('td#page table.data');

        $rows = $table->find('tr');
        $navigations = $rows[count($rows) - 1]->find('td a');
        $countMaxNav = $navigations[count($navigations) - 1]->text();

        $bargains = $table->find('tr[class]');

        $bargainsArr = [];

        foreach ($bargains as $bargain) {
            $bargainsArr[] = [
                'id' => $this->getDetailId($bargain),
                'number' => $bargain->first('td')->text(),
                'status' => $bargain->find('td')[3]->text()
            ];
        }

        return [
            'bargains' => $bargainsArr,
            'countMaxNav' => $countMaxNav
        ];
    }

    public function parseDetail($html, $id, $number)
    {
        $document = new Document($html, false, 'windows-1251');
        $infoBlock = $document->find('#info')[0];
        $infoDataTables = $infoBlock->child(1)->find('table');


        $dataItem = [];
        foreach ($infoDataTables as $item) {
            $rowsProps = $item->find('tbody tr');
            $props = [];
            foreach ($rowsProps as $row) {
                $props[trim($row->first('td')->text())] = trim($row->find('td')[1]->text());
            }
            $dataItem[trim($item->first('thead')->first('tr')->first('th')->text())] = $props;
        }

        // search files
        $dataItem['files'] = $this->parseFiles($id);


        //search lots
        $dataItem['lots'] = $this->parseLots($id);

        $dataItem['extId'] = $id;

        $dataItem['number'] = $number;

        return BargainDto::fromParseArray($dataItem);
    }

    public function parseLots($id)
    {
        $html = $this->fetchBargainService->fetchLots($id);
        $document = new Document($html, false, 'windows-1251');
        $tableLots = $document->find('table.data > tbody');
        $lots = [];
        foreach ($tableLots as $table){
            $rows = $table->find('tr');
            $lot = [];
            foreach ($rows as $row){
                $cels = $row->find('td');
                if(count($cels) == 2){
                    if($fileBox = $cels[1]->first('div')){
                        $lot['files'][] = [
                            'src' => config('services.auction.url') . $fileBox->first('a')->getAttribute('href'),
                            'name' => trim($fileBox->first('a')->text())
                        ];
                    }else{
                        $lot[trim($cels[0]->text())] = trim($cels[1]->text());
                    }
                }elseif(count($cels)) {
                    $periodTable = $cels[0]->first('table.data.inner');
                    if($periodTable){
                        $periodRows = $periodTable->find('tr');
                        foreach ($periodRows as $keyPeriod => $periodRow) {
                            if ($keyPeriod > 0) {
                                $celsPeriod = $periodRow->find('td');
                                $lot['periods'][] = [
                                    'startDate' => $celsPeriod[0]->text(),
                                    'endDate' => $celsPeriod[1]->text(),
                                    'startDPrice' => $celsPeriod[2]->text(),
                                    'endPrice' => $celsPeriod[3]->text(),
                                ];
                            }
                        }
                    }

                }
            }

            if(count($lot)){
                $lots[] = $lot;
            }
        }



        return $lots;

    }

    public function parseFiles($id) :array
    {
        $docFiles = new Document($this->fetchBargainService->fetchFiles($id), false, 'windows-1251');
        $files = [];
        foreach ($docFiles->first('table')->find('tr') as $key => $rowFile){
            if($key > 0){
                $path_file = $rowFile->first('td > div > a');
                if($path_file){
                    $fileNameArray = explode('.', $path_file->getAttribute('href'));
                    $files[] = [
                        'src' =>  config('services.auction.url') . $path_file->getAttribute('href'),
                        'name' => $rowFile->first('td')->text() . '.' . $fileNameArray[count($fileNameArray) - 1]
                    ];
                }
            }
        }
        return $files;
    }

    public function getDetailId($row): int
    {
        $clickAttr = $row->getAttribute('onclick');
        preg_match("/window.open\('(.*)',/", $clickAttr, $matches);
        if ($matches[1]) {
            parse_str(parse_url(config('services.auction.url') . $matches[1], PHP_URL_QUERY), $queryArray);
            return (int)$queryArray['id'];
        }

        return 0;

    }

}
