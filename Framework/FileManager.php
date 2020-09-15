<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 15/07/2020
 * Time: 11:24
 */

namespace App\Framework;

/**
 * Class FileManager
 *
 * @package App\Framework
 */
class FileManager
{
    /**
     * Varaiable listCssFile
     *
     * @var array
     */
    private $listCssFile;

    /**
     * Variable $listJsFile
     *
     * @var array
     */
    private $listJsFile;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->listCssFile = array();
        $this->listJsFile = array();
    }

    /**
     * Method addCssFile
     *
     * @param string $file css file
     */
    public function addCssFile($file)
    {
        $this->listCssFile[] = $file;
    }

    /**
     * Method addJsFile
     *
     * @param string $file Js file
     */
    public function addJsFile($file)
    {
        $this->listJsFile[] = $file;
    }

    /**
     * Method generateCss
     *
     * @return string
     */
    public function generateCss()
    {
        $cssContent = '';
        foreach ($this->listCssFile as $cssFile) {
            $cssContent .= '<link rel="stylesheet" type="text/css" href="' . $cssFile . '" />';
        }
        return $cssContent;
    }

    /**
     * Method generateJs
     *
     * @return string
     */
    public function generateJs()
    {
        $jsContent = '';
        foreach ($this->listJsFile as $jsFile) {
            $jsContent .= '<script src="' . $jsFile . '"></script>';

        }
        return $jsContent;
    }
}