<?php

namespace Modules\Member\Entities\Traits;
use Image;
trait FileManager
{

    public function _storeImg ( $file , $folder_name="default" , $storge_name ='public_uploads' )
    {   
        if ( file_exists( $file) ) {
           return $file->store($folder_name , $storge_name);
        }
        
    }

    public function _deleteImg ( $file )
    {   
        if ( file_exists( $file) && ! is_dir($file ) ) {
            if ( ! unlink( $file ) )  {
                return $this->_ForceDelete( $file );
            }
        }
    }

    public function src($size, $folder, $file)
    {
        if (empty($file)) return $this->defaultSrc($size, $folder);

        return $this->baseUrl 
        . 'graph/uploads/' 
        . $size 
        . '/' 
        . $file;
    }

    public function defaultSrc($size, $folder)
    {
        return $this->baseUrl 
        . 'graph/uploads/' 
        . $size . '/' 
        . $this->config['DEFAULT_FOLDERS_FILES'][$folder];
    }
}
