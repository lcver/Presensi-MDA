<?php

/**
 * 
 * 
 * call controller
 */
use App\Core\Controller;

class SesiModel extends Controller
{
    /**
     * 
     * create view resource data
     */
    public function create(){
        return Database::table('sesi')
                                    ->join('jadwal')
                                    ->on('sesi.idJadwal','jadwal.id')
                                    ->orderBy('tanggal asc, sesi.waktu_mulai','asc')
                                    ->fetch(['sesi.*','jadwal.tanggal'])
                                    ->get();
    }
        /**
         * 
         * stored new resourece data
         */
        public function store(array $request){
            return Database::table('sesi')->insert($request);
        }
            /**
             * 
             * display the specified resource data
             */
            public function show($request,$data=null){
                switch ($request) {
                    case 'get_active':
                        $result = Database::table('sesi')
                                                        ->join('jadwal')
                                                        ->on('sesi.idJadwal','jadwal.id and jadwal.status=2 and sesi.status=2')
                                                        ->orderBy('jadwal.tanggal asc, sesi.waktu_mulai','asc')
                                                        ->fetch(['sesi.*','jadwal.tanggal'])
                                                        ->get();
                        break;
                    case 'set_active':
                        $result = Database::table('sesi')
                                                        ->join('jadwal')
                                                        ->on('sesi.idJadwal','jadwal.id and jadwal.status=2')
                                                        ->orderBy('jadwal.tanggal asc, waktu_mulai','asc')
                                                        ->fetch(['sesi.*','jadwal.tanggal'])
                                                        ->get();
                        break;
                    case 'byId':
                        $result = Database::table('sesi')
                                                        ->where('id',$data)
                                                        ->orderBy('waktu_mulai','asc')
                                                        ->get();
                        break;
                    case 'get_by_jadwal':
                        $result = Database::table('sesi')
                                                    ->where('idJadwal',$data)
                                                    ->get();
                        break;
                    case 'auto_sesi':
                        $result = Database::table('sesi')
                                                    ->join('jadwal')
                                                    ->on('sesi.idJadwal',"jadwal.id and jadwal.status=2 and sesi.status=1 and sesi.auto_active='active'")
                                                    ->orderBy('jadwal.tanggal asc, waktu_mulai','asc')
                                                    ->fetch(['sesi.*','jadwal.tanggal'])
                                                    ->get();
                        break;
                    default:
                        $result = [];
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
                    public function update($id, $request){
                        return Database::table('sesi')
                                                    ->where('id',$id)
                                                    ->update($request);
                    }
                        /**
                         * 
                         * remove specified resource data
                         */
                        public function destroy($id){
                            return Database::table('sesi')
                                                    ->delete($id);
                        }
}
