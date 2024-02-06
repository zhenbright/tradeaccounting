<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use XBase\TableReader;
use App\DBF;
use DB;

class DBFController extends Controller
{
    //
    protected $db_file_path = '';
    protected $table;
    public function __construct(){
        $this->db_file_path= database_path('db\TRANSFER.DBF');
    }
    public function index()  {
        $filepath = database_path('db\TRANSFER.DBF');
        $table = new TableReader($filepath);
        echo 'Record count: '.$table->getRecordCount();

        $columns = $table->getColumns();

        foreach ($columns as $column) {
            echo $column.'<br>';
        }

        $i = 0;
        while ($record = $table->nextRecord()) {
            $s = [];
            foreach ($columns as $column) {
                $s[] = $record->get($column->getName());
            }
            $str = implode(',', $s);
            echo $str.'<br>';
            // if (++$i % 1000 == 0) {
            //     echo "{$i} >> ".round(memory_get_usage() / (1024 * 1024))." MB\n";
            // }
        }

    }
    public function view(Request $request, $view) {

        $products = $this->getProductList($request);
        $DBF = new DBF();
        switch ($view) {
            case 'trading_down':
                # code...
                $columns = $this->getTableHeaderColumns();
                $fields = $this->getColumns();
                $godowns = $DBF->getGodowns();
                return view('app.godowntransfer', [
                                'table_columns' => $columns,
                                'fields' => $fields, 
                                'godowns' => $godowns, 
                                'products' => $products['data']
                            ]);
            default:
                # code...
                break;
        }
    }

    public function getProductList(Request $request) {
        $tableReader = new TableReader(database_path('db\PMPL.DBF'));
    
        $columns = ['code','product', 'pack', 'gst', 'mrp1', 'rate1', 'mult_f'];
        $records = [];
        while ($record = $tableReader->nextRecord()) {
            $s = [];
            $records[$record->get('code')] = [];
            
            foreach($columns as $column) {
                $records[$record->get('code')][$column] = $record->get($column);
            }
            $records[$record->get('code')]['qty'] = 0;
        }
        // die;
        $tableReader = new TableReader(database_path('db\purdtl.DBF'));
        
        while ($record = $tableReader->nextRecord()) 
            if (isset($records[$record->get('code')])) $records[$record->get('code')]['qty'] += $record->get('qty');
        
        $tableReader = new TableReader(database_path('db\billdtl.DBF'));
        
        while ($record = $tableReader->nextRecord()) 
            if (isset($records[$record->get('code')])) $records[$record->get('code')]['qty'] -= $record->get('qty');
        
        if ($request->ajax()) {
            $utf8Data = array_map(function ($item) {
                return array_map('utf8_encode', $item);
            }, $records);
            $res = [];
            foreach ($utf8Data as $key => $value) {
                $res[] = $value;
            }
            // print_r($res);die;
            return ['data' => $res];
        } else
            return ['data' => $records];
    }

    public function getColumns() {

        $columns = ['code', 'pack', 'gst', 'unit', 'mrp', 'rate', 'qty','ok'];
        return $columns;
    }

    public function getTableHeaderColumns() {
        $columns = ['Code', 'Product', 'Pack', 'GST%',  'Mrp', 'Rate', 'PIB', 'Stock'];
        return $columns;
    }

    public function getRecords()
    {
        
        $tableReader = new TableReader(database_path('db\TRANSFER.DBF'));
        $columns = $this->getColumns();
        $records = [];
        while ($record = $tableReader->nextRecord()) {
            $s = [];
            foreach ($columns as $column) {
                $s[$column] = $record->get($column);
            }
            array_push($records, $s);
        }
        return ['data' => $records ];
    }
}
