<?php
function getModels() { 

    $dh = @opendir( $path );
    while( false !== ( $file = readdir( $dh ) ) ){
        if( !in_array( $file, $ignore ) ){
            $spaces = str_repeat( ' ', ( $level * 4 ) );
            if( is_dir( "$path/$file" ) ){
                getDirectory( "$path/$file", ($level+1) );
            } else {
                if(substr($file, -3) == "php"){
                    
                };
            }
        }
    }
    closedir( $dh );
};
//getDirectory( "/Applications/MAMP/htdocs/towblog/model" );
//getDirectory( "/Applications/MAMP/htdocs/towblog/tests/model" );
/*
 * magicpath.php
 * Copyright 2013 Stefano Sabatini
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at 
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */

spl_autoload_register(function ($class) {
       require_once $_SERVER['DOCUMENT_ROOT']."/$class.php";
});


?>