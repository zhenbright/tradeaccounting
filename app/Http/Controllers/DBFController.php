<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use XBase\Table\Table;
use XBase\TableReader;
use XBase\TableEditor;
use XBase\Record\RecordFactory;
use XBase\Record\RecordInterface;
use App\Models\DbfModel;
use App\DBF;
use DB;

class DBFController extends Controller
{
    //
    protected $db_file_path = '';
    protected $table;
    public $wel;

    
    public function __construct(){
        $this->db_file_path= database_path('db\TRANSFER.DBF');
        $this->wel = NULL;
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
    public function view(Request $request, string $view) {

        $products = $this->getProductList($request);
        $val = $this->getMax();
        // echo $val;
        // die;
        $DBF = new DBF();
        // echo $this->$wel;
        switch ($view) {
            case 'trading_down':
                # code...
                // echo "asdf";
                // die;
                $columns = $this->getTableHeaderColumns();
                $fields = $this->getColumns();
                $godowns = $DBF->getGodowns();
                return view('app.godowntransfer', [
                                'table_columns' => $columns,
                                'fields' => $fields, 
                                'godowns' => $godowns, 
                                'products' => $products['data'],
                                'max' => $val
                            ]);
            default:
                # code...
                break;
        }
    }

    public function getMax() {
        $tableReader = new TableReader(database_path('db\TRANSFER.DBF'));
        $val = 0;
        while( $record = $tableReader->nextRecord() ) {
            if($val < $record->get('bill')) $val = $record->get('bill');
        }
        return  $val;
        // die;
    }

    public function getProductList(Request $request) {
        $tableReader = new TableReader(database_path('db\PMPL.DBF'));
        
        // $val = $tableReader->max('mult_f');

        // echo $val;
        // die;
        $columns = ['code','product', 'pack', 'gst', 'mrp1', 'rate1', 'mult_f','PRODUCT_L','unit_1'];
        $records = [];
        while ($record = $tableReader->nextRecord()) {
            foreach($columns as $column) {
                $records[$record->get('code')][$column] = $record->get($column);
            }
            $records[$record->get('code')]['qty'] = 0;
        }
        // die;

        $tableReader->close();
        // $tableReader = new TableReader(database_path('db\purdtl.DBF'));
        // while ($record = $tableReader->nextRecord()) {

        //     if (isset($records[$record->get('code')])) {
        //         $records[$record->get('code')]['qty'] += $record->get('qty');
        //     }

        // }

        // $tableReader->close();
        // $tableReader = new TableReader(database_path('db\billdtl.DBF'));
        
        // while ($record = $tableReader->nextRecord()) 
        //     if (isset($records[$record->get('code')])) $records[$record->get('code')]['qty'] -= $record->get('qty');


        if ($request->ajax()) {
            $utf8Data = array_map(function ($item) {
                return array_map('utf8_encode', $item);
            }, $records);
            $res = [];
            foreach ($utf8Data as $key => $value) {
                $res[] = $value;
            }
            return ['data' => $res];
        } else
            return ['data' => $records];
    }

    public function getColumns() {

        $columns = ['code', 'pack', 'gst', 'unit', 'mrp', 'rate', 'qty','ok'];
        return $columns;
    }

    public function getTableHeaderColumns() {
        $columns = ['Code', 'Product', 'Pack', 'GST%',  'Mrp', 'Rate', 'PIB', 'Stock','Unit'];
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

    public function saveRecords(Request $request) {

        // $ddd =  $request['dt_Date'];
        // echo $ddd;
        // die;
        // $record->date_format("YYYYMMDD")
        // echo $record->date_format($ddd,"YYYYMMDD");
        // die;
        // echo $request['dt_Date'];
        // die;
        $tableDataes = $request->tableData;

        $filePath = database_path('db\TRANSFER.DBF');

        // Create a new table
        $table = new Table($filePath);

        // Create a TableWriter instance
        $tableWriter = new TableEditor($filePath);

        // Create a new record


        // Set values for the record
        $columns = $tableWriter->getColumns();



        foreach($tableDataes as $tableData) {
            $record = $tableWriter->appendRecord();
            $record->set('SERIES', 'T');
            $record->set('BILL',$request['bill']);
            $record->set('DATE',$request['dt_Date']);
            $record->set('CODE',$tableData['code']);
            $record->set('GDN_CODE',$request['go']); 
            $record->set('UNIT',$tableData['unit_1']);
            $record->set('MULT_F',$tableData['mult_f']);
            $record->set('TRADE',$request['fromdown']);
            $record->set('MRP',$tableData['mrp1']);
            $record->set('RATE',$tableData['rate1']);
            $record->set('QTY',$tableData['qty']);

            $record->set('BATCH_NO',null);
            $record->set('EXPIRY',null);
            $record->set('LST',null);
            $record->set('GST',null);
            $record->set('SNO',null);
            $record->set('BILL2',null);
            $record->set('AMT10',null);
            $record->set('NET10',null);
            $record->set('GD10',null);
            $record->set('GST10',null);
            $record->set('GR_CODE9',null);
            $record->set('PRODUCT',$tableData['product']);
            $record->set('PACK',$tableData['pack']);
            $record->set('OK',$tableData['ok']);
            $record->set('UNIT_NO',null);
            $record->set('EXP_C',null);
            $record->set('REF_NO',null);
            $record->set('TRF_TO',null);
            // $tableWriter
            $tableWriter
            ->writeRecord()
            ->save();


            $record = $tableWriter->appendRecord();
            $record->set('SERIES', 'T');
            $record->set('BILL',$request['bill']);
            $record->set('DATE',$request['dt_Date']);
            $record->set('CODE',$tableData['code']);
            $record->set('GDN_CODE',$request['todown']); 
            $record->set('GDN_CODE',null); 
            $record->set('UNIT',$tableData['unit_1']);
            $record->set('MULT_F',$tableData['mult_f']);
            $record->set('TRADE',null);
            $record->set('MRP',$tableData['mrp1']);
            $record->set('RATE',$tableData['rate1']);
            $record->set('QTY',$tableData['qty']);

            $record->set('BATCH_NO',null);
            $record->set('EXPIRY',null);
            $record->set('LST',null);
            $record->set('GST',null);
            $record->set('SNO',null);
            $record->set('BILL2',null);
            $record->set('AMT10',null);
            $record->set('NET10',null);
            $record->set('GD10',null);
            $record->set('GST10',null);
            $record->set('GR_CODE9',null);
            $record->set('PRODUCT',$tableData['product']);
            $record->set('PACK',$tableData['pack']);
            $record->set('OK',$tableData['ok']);
            $record->set('UNIT_NO',null);
            $record->set('EXP_C',null);
            $record->set('REF_NO',null);
            $record->set('TRF_TO',null);
            // $tableWriter
            $tableWriter
            ->writeRecord()
            ->save();
            
        }

        // foreach ($columns as $column) {
        //     # code...
        //     $type = $column->getType();
        //     // $record->set($column->getName(), '11111');
        //     switch ($type) {
        //         case 'C':
        //             $record->set($column->getName(), 'T');
        //             break;
        //         case 'D':
        //             $record->set($column->getName(), null);
        //             break;
        //         default:
        //             $record->set($column->getName(), 1);
        //         break;
        //     }
        // }
        $tableWriter->close();

        return ['success' => true, 'record' => $record] ;

    }

    public function welcome(Request $request) {
        
        // $this->wel = $this->getProductList($request);
        // echo $this->wel['data'];
        // die;
        return view('welcome');
    }
}
