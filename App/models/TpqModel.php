<?php

/**
 * 
 * 
 * call controller
 */
use App\Core\Controller;

class TpqModel extends Controller
{
    /**
     * 
     * create view resource data
     */
    public function create(){
        return Database::table('tbpresensi_tpq')->get();
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
            public function show($request){
                return Database::table('tbpresensi_tpq')
                                            ->where('id',$request)
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
                    public function update($id){}
                        /**
                         * 
                         * remove specified resource data
                         */
                        public function destroy($id){}
}
