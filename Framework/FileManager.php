<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 15/07/2020
 * Time: 11:24
 */

namespace App\Framework;


class FileManager
{
    private $listCssFile;
    private $listJsFile;

    public function __construct()
    {
        $this->listCssFile = array();
        $this->listJsFile = array();
    }

    public function addCssFile($file)
    {
        $this->listCssFile[] = $file;
    }

    public function addJsFile($file)
    {
        $this->listJsFile[] = $file;
    }

    public function generateCss()
    {
        $cssContent = '';
        foreach ($this->listCssFile as $cssFile) {
            $cssContent .= '<link rel="stylesheet" type="text/css" href="' . $cssFile . '" />';
        }
        return $cssContent;
    }

    public function generateJs()
    {
        $jsContent = '';
        foreach ($this->listJsFile as $jsFile) {
            $jsContent .= '<script src="' . $jsFile . '"></script>';

        }
        return $jsContent;
    }
}