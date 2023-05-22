<?php
# @Author: Awan Tengah
# @Date:   2017-05-03T09:36:27+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-03T10:57:09+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function zip_image_product() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {

            $get_zip_for = $this->input->post('ZIP_FOR', true);

            if(!is_null($get_zip_for) && !empty($get_zip_for)) {
                $zipname = 'image_';
                if(($get_zip_for == 'sleeve') || ($get_zip_for == 'product') || ($get_zip_for == 'fabric') || ($get_zip_for == 'collar') || ($get_zip_for == 'cuff') || ($get_zip_for == 'body_type') || ($get_zip_for == 'pocket') || ($get_zip_for == 'buttons') || ($get_zip_for == 'cleric') || ($get_zip_for == 'embroidery') || ($get_zip_for == 'option')) {
                    $zipname .= $get_zip_for;
                    if($get_zip_for == 'product') {
                        $location_name = 'product_image';
                    } else if($get_zip_for == 'cleric') {
                        $location_name = 'material_cleric_category';
                    } else {
                        $location_name = 'material_' . $get_zip_for;
                    }
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'ZIP_FOR NOT FOUND';
                    $datapi['DATA'] = (object)array();

                    return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($datapi));
                }

                $zip_location = "assets/zip/{$zipname}.zip";

                $zip = new ZipArchive;
                if ($zip->open($zip_location, ZipArchive::CREATE) === TRUE){

                    if ($get_zip_for != 'sleeve') {
                        foreach (new DirectoryIterator("assets/img/upload/{$location_name}") as $fileInfo) {
                            if (in_array($fileInfo->getFilename(), [ ".", "..", "object" ])) { continue; }
                            $fileName = $fileInfo->getPathname();
                            $new_filename = substr($fileName,strrpos($fileName,'/') + 1);
                            $zip->addFile($fileName, $new_filename);
                        }
                    }

                    if ($get_zip_for == 'collar' || $get_zip_for == 'cuff' || $get_zip_for == 'pocket') {
                        foreach (new DirectoryIterator("assets/img/upload/{$location_name}/object") as $fileInfo) {
                            if (in_array($fileInfo->getFilename(), [ ".", ".." ])) { continue; }
                            $fileName = $fileInfo->getPathname();
                            $new_filename = substr($fileName,strrpos($fileName,'/') + 1);
                            $zip->addFile($fileName, $new_filename);
                        }
                    }

                    if ($get_zip_for == 'cleric') {
                        foreach (new DirectoryIterator("assets/img/upload/material_cleric") as $fileInfo) {
                            if (in_array($fileInfo->getFilename(), [ ".", ".." ])) { continue; }
                            $fileName = $fileInfo->getPathname();
                            $new_filename = substr($fileName,strrpos($fileName,'/') + 1);
                            $zip->addFile($fileName, $new_filename);
                        }
                    }

                    if ($get_zip_for == 'sleeve') {
                        $query = $this->db->query('SELECT * FROM material_cuff WHERE category = 2');
                        if ($query->num_rows() > 0) {
                            foreach ($query->result() as $row_sleeve) {
                                foreach (new DirectoryIterator("assets/img/upload/material_cuff") as $fileInfo) {
                                    if ($fileInfo->getFilename() == $row_sleeve->image) {
                                        if (in_array($fileInfo->getFilename(), [ ".", "..", "object" ])) { continue; }
                                        $fileName = $fileInfo->getPathname();
                                        $new_filename = substr($fileName,strrpos($fileName,'/') + 1);
                                        $zip->addFile($fileName, $new_filename);
                                    }
                                }
                            }

                            foreach ($query->result() as $row_sleeve) {
                                foreach (new DirectoryIterator("assets/img/upload/material_cuff/object") as $fileInfo) {
                                    if ($fileInfo->getFilename() == $row_sleeve->object || $fileInfo->getFilename() == $row_sleeve->mtl) {
                                        if (in_array($fileInfo->getFilename(), [ ".", ".." ])) { continue; }
                                        $fileName = $fileInfo->getPathname();
                                        $new_filename = substr($fileName,strrpos($fileName,'/') + 1);
                                        $zip->addFile($fileName, $new_filename);
                                    }
                                }
                            }
                        }
                    }

                    $zip->close();
                }

                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'CREATE ZIP SUCCESS';
                $datapi['DATA'] = array(
                    'ZIP' => $zip_location
                );
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'CREATE ZIP FAILED';
                $datapi['DATA'] = (object)array();
            }

        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

}
