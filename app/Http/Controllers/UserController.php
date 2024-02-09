<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use XBase\Table;
use XBase\TableReader;
use XBase\TableWriter;
use XBase\TableEditor;
class UserController extends Controller
{
    //
    public function __construct(){

    }

    public function Login(Request $request) {

        $tableReader = new TableReader(database_path('db\TRANSFER.DBF'));

        // $columns = ['UseID','Password'];
        while ($record = $tableReader->nextRecord()) {
            $userid = $record.get('UserID');
            $pass = $record.get('Password');
            if($userid == $request['userid'] && $pass == $request['pass']) {
                return ['success' => ture,'userid' => $userid];
            } 
        }
        return ['success' => false];
         

    }

    public function Register(Request $request) {

        $filePath = database_path('db\TRANSFER.DBF');

        // Create a new table
        $table = new Table($filePath);

        // Create a TableWriter instance
        $tableWriter = new TableEditor($filePath);
        $record = $tableWriter->appendRecord();
        
        $record->set('ID',1);
        $record->set('Name',$request['name']);
        $record->set('UserID',$request['userid']);
        $record->set('pass',$request['pass']);

        $tableWriter
        ->writeRecord()
        ->save()
        ->close();
    }
}
