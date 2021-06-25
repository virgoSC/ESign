<?php

namespace ESign\District;

/**
 * 组件类
 * Class StructComponent
 * @package ESign\District
 */
class StructComponent
{
    const TYPE_TEXT = 1;
    const TYPE_NUM = 2;
    const TYPE_DATE = 3;
    const TYPE_AREA = 6;
    const TYPE_MTEXT = 8;
    const TYPE_PHOTO = 11;

    private $structId;
    private $type;
    private $label;
    private $required = true;
    private $limit;
    private $width;
    private $height;
    private $font = 1;
    private $fontSize = 12;
    private $textColor = '#000000';
    private $page;
    private $x;
    private $y;

    public function generate(): array
    {
        $component = [
            'type' => $this->getType(),
            'context' => [
                'label' => $this->getLabel(),
                'style' => [
                    'width' => $this->getWidth(),
                    'height' => $this->getHeight(),
                    ''
                ],
                'pos' => [
                    'page' => $this->getPage(),
                    'x' => $this->getX(),
                    'y' => $this->getY()
                ]
            ]
        ];

        if ($this->getStructId()) {
            $component['id'] = $this->getStructId();
        }
        if (!$this->isRequired()) {
            $component['context']['required'] = false;
        }
        if ($this->limit) {
            $component['context']['limit'] = $this->getLimit();
        }
        if ($this->getFont()) {
            $component['context']['style']['font'] = $this->getFont();
        }

        if ($this->getFontSize()) {
            $component['context']['style']['fontSize'] = $this->getFontSize();
        }

        if ($this->getTextColor()) {
            $component['context']['style']['fontSize'] = $this->getTextColor();
        }

        return $component;
    }

    /**
     * @return mixed
     */
    public function getStructId()
    {
        return $this->structId;
    }

    /**
     * @param mixed $structId
     */
    public function setStructId($structId): void
    {
        $this->structId = $structId;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label): void
    {
        $this->label = $label;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     */
    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param mixed $limit
     */
    public function setLimit($limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getFont(): int
    {
        return $this->font;
    }

    /**
     * @param int $font
     */
    public function setFont(int $font): void
    {
        $this->font = $font;
    }

    /**
     * @return int
     */
    public function getFontSize(): int
    {
        return $this->fontSize;
    }

    /**
     * @param int $fontSize
     */
    public function setFontSize(int $fontSize): void
    {
        $this->fontSize = $fontSize;
    }

    /**
     * @return string
     */
    public function getTextColor(): string
    {
        return $this->textColor;
    }

    /**
     * @param string $textColor
     */
    public function setTextColor(string $textColor): void
    {
        $this->textColor = $textColor;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page): void
    {
        $this->page = $page;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param mixed $x
     */
    public function setX($x): void
    {
        $this->x = $x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param mixed $y
     */
    public function setY($y): void
    {
        $this->y = $y;
    }
}
