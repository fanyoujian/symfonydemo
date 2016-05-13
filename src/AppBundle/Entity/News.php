<?php

namespace AppBundle\Entity;

/**
 * News
 */
class News
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $banner_url;


    /**
     * Get banner_url
     * @return string
     */
    public function getBanenrUrl()
    {
        return $this->banner_url;
    }

    /**
     * Set banner_url
     *
     * @param string $banner_url
     *
     * @return News
     */
    public function setBannerUrl($banerurl)
    {
        $this->banner_url = $banerurl;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return News
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

   
}

