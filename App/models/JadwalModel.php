<?php

/**
 * 
 * 
 * call controller
 */
use App\Core\Controller;

class JadwalModel extends Controller
{
    /**
     * 
     * create view resource data
     */
    public function create(){
        return Database::table('jadwal')
                                    ->orderBy('tanggal','asc')
                                    ->get();
    }
        /**
         * 
         * stored new resourece data
         */
        public function store($request){
            return Database::table('jadwal')->insert($request);
        }
            /**
             * 
             * display the specified resource data
             */
            public function show($request,$cond=null){
                switch ($request) {
                    case 'get_last_id':
                        $result = Database::table('jadwal')
                                                        ->orderBy('id','desc limit 1')
                                                        ->fetch(['id'])
                                                        ->get();
                        break;
                    case 'get_inactive_jadwal':
                        $result = Database::table('jadwal')
                                                        ->where('status',1)
                                                        ->get();
                        break;
                    case 'get_active_jadwal':
                        $result = Database::table('jadwal')
                                                        ->where('status',2)
                                                        ->get();
                        break;
                    case 'get_all_by_jadwal':
                        $result = Database::table('jadwal')
                                                        ->join('peserta')
                                                        ->on('jadwal.id','peserta.idJadwal and jadwal.id ='.$cond)
                                                        ->fetch(['tanggal'])
                                                        ->get();
                        break;
                    case 'get_by_id' :
                        $result = Database::table('jadwal')
                                                    ->where('id',$cond['id'])
                                                    ->get();
                        break;
                    case 'get_three_last' :
                        $result = Database::table('jadwal')
                                                    ->orderBy('id','desc limit 3')
                                                    ->get();
                        break;
                    default:
                        # code...
                        break;
                }
                return $result;
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
                        return Database::table('jadwal')
                                                    ->where('id',$id)
                                                    ->update($request);
                    }
                        /**
                         * 
                         * remove specified resource data
                         */
                        public function destroy($id){
                            return Database::table('jadwal')->delete($id);
                        }
}
