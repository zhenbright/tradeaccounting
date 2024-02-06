<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use XBase\TableReader;

class DBF extends Model
{
    //
    public function getGodowns() {
        $tableReader = new TableReader(database_path('db\GODOWN.DBF'));
        $columns = $tableReader->getColumns();
        $records = [];
        // echo $tableReader->getRecordCount();die;
        while ($record = $tableReader->nextRecord()) {
            $s = [];
            foreach ($columns as $column) {
                $s[$column->getName()] = $record->get($column->getName());
            }
            array_push($records, $s);
        }
        
        return $records;
    }
}
