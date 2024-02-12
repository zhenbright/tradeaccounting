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

use Session;

class UserController extends Controller
{
    //
    public function __construct(){

    }

    public function Login(Request $request) {

        $tableReader = new TableReader(database_path('db\users.DBF'));

        // $columns = ['UseID','Password'];
        while ($record = $tableReader->nextRecord()) {
            $userid = $record->get('UserID');
            $pass = $record->get('Password');
            if($userid == $request['userID'] && $pass == $request['password']) {
                Session::put('userid', $userid);
                return redirect('/dashboard');
            } 
        }
        return redirect('/login');
        // Session::put('userid', $userid);
        // return ['success' => false];

    }

    public function Register(Request $request) {

        $filePath = database_path('db\users.DBF');

        $tableReader = new TableReader($filePath);

        while($record = $tableReader->nextRecord()) {
            if($record->get('UserID') == $request['userID']) {
                return redirect('/register');
            }
        }

        $tableWriter = new TableEditor($filePath);
        $record = $tableWriter->appendRecord();
        $record->set('ID',1);
        $record->set('Name',$request['name']);
        $record->set('UserID',$request['userID']);
        $record->set('Password',$request['password']);

        Session::put('userid',$request['userID']);
        $tableWriter
        ->writeRecord()
        ->save()
        ->close();
        return redirect('/dashboard');
        // return window.location(url("/dbf"));
    }
}
