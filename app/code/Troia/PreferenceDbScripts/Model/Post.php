<?php

namespace Troia\PreferenceDbScripts\Model;

class Post extends \Perspective\DbScripts\Model\Post
{

    public function prefName(){
        return "magento2_name_" . $this->getName();
    }

    public function shortUlr(){
        $getUrl = $this->getUrlKey();
        $getUrl = trim($getUrl);
        $url = str_replace("\n", '', $getUrl);
        $url = str_replace(' ', '-', $url);
        $url = str_replace('magento-2-module-development', 'mag2-m-d', $url);
        $url = str_replace('magento-2-', '', $url);
        return $url;
    }

}
