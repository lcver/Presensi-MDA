<?php

/**
 * 
 * 
 * call controller
 */
use App\Core\Controller;

class SuperadminModel extends Controller
{
    /**
     * 
     * create view resource data
     */
    public function create(){
    }
        /**
         * 
         * stored new resourece data
         */
        public function store(){}
            /**
             * 
             * display the specified resource data
             */
            public function show(){
                return Database::table('tbpresensi_superadmin')
                                        ->where('id',$_SESSION['presensi_adminsession'])
                                        ->get();
            }
            public function auth($request)
            {
                $db = new Database;
                $request = $db->escapeString($request);
                return Database::table('tbpresensi_superadmin')
                                    ->where('password',$request)
                                    ->get();
            }
                /**
                 * 
                 * display form for editing resource data
                 */
                public function edit($id){}
                    /**
                     * 
                     * update the specified resource data
                     */
                    public function update($id,$request){
                        return Database::table('tbpresensi_superadmin')
                                                    ->where('id',$id)
                                                    ->update($request);
                    }
                        /**
                         * 
                         * remove specified resource data
                         */
                        public function destroy($id){}
}
