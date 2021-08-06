<?php


namespace Astaroth\VkUtils\Builders\Attachments\AbstractAttachments;


abstract class AbstractPhoto extends AbstractFile
{
    /**
     * @see Trick for KPHP
     * AbstractPhoto constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        parent::__construct($path);
    }

    protected ?int $group_id = null;
    protected ?int $album_id = null;
    protected ?int $chat_id = null;
    protected ?int $x = null;
    protected ?int $y = null;
    protected ?int $crop_width = null;

    /**
     * @param int $group_id
     * @return static
     */
    protected function _setGroupId(int $group_id)
    {
        $this->group_id = $group_id;
        return $this;
    }


    /**
     * @param int $album_id
     * @return static
     */
    protected function _setAlbumId(int $album_id)
    {
        $this->album_id = $album_id;
        return $this;
    }

    /**
     * @param int $chat_id
     * @return static
     */
    protected function _setChatId(int $chat_id)
    {
        $this->chat_id = $chat_id;
        return $this;
    }

    /**
     * @param int $x
     * @return static
     */
    protected function _setCropX(int $x): AbstractPhoto
    {
        $this->x = $x;
        return $this;
    }

    /**
     * @param int $y
     * @return static
     */
    protected function _setCropY(int $y)
    {
        $this->y = $y;
        return $this;
    }

    /**
     * @param int $crop_width
     * @return static
     */
    protected function _setCropWidth(int $crop_width)
    {
        $this->crop_width = $crop_width;
        return $this;
    }

    public function getConcreteType(): string
    {
        return "photo";
    }

    public function getPostFileType(): string
    {
        return "file";
    }
}