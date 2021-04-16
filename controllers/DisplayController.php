<?php

namespace Controllers;

use App\Auth;

class DisplayController
{
    public function display($request)
    {
        if (!empty($request->files->name[0])) {
            $images = '';
            $controllers = '';
            for ($i = 0; $i < count($request->files->name); $i++) {
                if ($i == 0) {
                    $id = 'active-image';
                } else {
                    $id = '';
                }
                $src = $request->files->tmp_name[$i];
                $name = Auth::id() . $i;
                if (move_uploaded_file($src, '../public/assets/images/temp/' . $name)) {
                    $images .= "
                    <li>
                        <img src='/assets/images/temp/$name' uk-cover style='height:100% !important'/>
                    </li>";

                    $controllers .= "
                    <li uk-slideshow-item='$i' id='$id'>
                        <a href='#'><img src='/assets/images/temp/$name' width='100'></a>
                    </li>
                    ";
                }
            }
            echo json_encode([
                'images' => $images,
                'controllers' => $controllers
            ]);
        }
    }
}
