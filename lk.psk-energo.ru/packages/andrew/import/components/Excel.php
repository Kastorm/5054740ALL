<?php

namespace andrew\import\components;

class Excel extends \moonland\phpexcel\Excel
{
    public function readFile($fileName)
    {
        if (!isset($this->format)) {
            $this->format = \PHPExcel_IOFactory::identify($fileName);
        }
        $objectreader = \PHPExcel_IOFactory::createReader($this->format);
        $objectPhpExcel = $objectreader->load($fileName);

        $sheetCount = $objectPhpExcel->getSheetCount();

        $sheetDatas = [];

        if ($sheetCount > 1) {
            foreach ($objectPhpExcel->getSheetNames() as $sheetIndex => $sheetName) {
                $objectPhpExcel->setActiveSheetIndexByName($sheetName);
                $indexed = $this->setIndexSheetByName == true
                    ? $sheetName
                    : $sheetIndex;
                $sheetDatas[$indexed] = $objectPhpExcel->getActiveSheet()
                    ->toArray(null, true, true, true);
                if ($this->setFirstRecordAsKeys) {
                    $sheetDatas[$indexed] = $this->executeArrayLabel($sheetDatas[$indexed]);
                }
                if (!empty($this->getOnlyRecordByIndex) && isset($this->getOnlyRecordByIndex[$indexed])
                    && is_array($this->getOnlyRecordByIndex[$indexed])
                ) {
                    $sheetDatas = $this->executeGetOnlyRecords($sheetDatas, $this->getOnlyRecordByIndex[$indexed]);
                }
                if (!empty($this->leaveRecordByIndex) && isset($this->leaveRecordByIndex[$indexed])
                    && is_array($this->leaveRecordByIndex[$indexed])
                ) {
                    $sheetDatas[$indexed] = $this->executeLeaveRecords($sheetDatas[$indexed],
                        $this->leaveRecordByIndex[$indexed]);
                }
            }
            if (isset($this->getOnlySheet) && $this->getOnlySheet != null) {
                $indexed = $this->setIndexSheetByName == true
                    ? $this->getOnlySheet
                    : $objectPhpExcel->getIndex($objectPhpExcel->getSheetByName($this->getOnlySheet));

                return $sheetDatas[$indexed];
            }
        } else {
            $sheetDatasTmp = $objectPhpExcel->getActiveSheet()
                ->toArray(null, true, true, true);
            if ($this->setFirstRecordAsKeys) {
                $sheetDatasTmp = $this->executeArrayLabel($sheetDatasTmp);
            }
            if (!empty($this->getOnlyRecordByIndex)) {
                $sheetDatasTmp = $this->executeGetOnlyRecords($sheetDatasTmp, $this->getOnlyRecordByIndex);
            }
            if (!empty($this->leaveRecordByIndex)) {
                $sheetDatasTmp = $this->executeLeaveRecords($sheetDatasTmp, $this->leaveRecordByIndex);
            }
            $sheetDatas[] = $sheetDatasTmp;
        }

        return $sheetDatas;
    }
}
