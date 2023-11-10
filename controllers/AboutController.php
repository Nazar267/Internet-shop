<?php

class AboutController{


    public function actionIndex(){

       $about = About::getAboutInfo();



        require_once(ROOT.'/views/about/index.php');
        return true;
    }



    
}
