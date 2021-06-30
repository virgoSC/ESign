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

    private $component = [];

    public function generate(): array
    {
        return $this->component;
    }

    public function append(): self
    {
        $component = [
            'type' => $this->getType(),
            'context' => [
                'label' => $this->getLabel(),
                'style' => [
                    'width' => $this->getWidth(),
                    'height' => $this->getHeight(),
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
            $component['context']['style']['textColor'] = $this->getTextColor();
        }

        $this->component[] = $component;
        $this->reset();
        return $this;
    }

    private function reset()
    {
        $vars = get_class_vars(get_class($this));

        foreach ($vars as $key=>$var) {
            if (is_array($var) or $var) {
                continue;
            } else {
                $this->$key = '';
            }
        }
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
    public function setStructId($structId): self
    {
        $this->structId = $structId;
        return $this;
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
    public function setType($type): self
    {
        $this->type = $type;
        return $this;

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
    public function setLabel($label): self

    {
        $this->label = $label;
        return $this;
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
    public function setRequired(bool $required): self
    {
        $this->required = $required;
        return $this;

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
    public function setLimit($limit): self
    {
        $this->limit = $limit;
        return $this;

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
    public function setWidth($width): self
    {
        $this->width = $width;
        return $this;

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
    public function setHeight($height): self
    {
        $this->height = $height;
        return $this;

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
     * @return StructComponent
     */
    public function setFont(int $font): self
    {
        $this->font = $font;
        return $this;

    }

    /**
     * @return float
     */
    public function getFontSize(): float
    {
        return $this->fontSize;
    }

    /**
     * @param float $fontSize
     * @return StructComponent
     */
    public function setFontSize(float $fontSize): self
    {
        $this->fontSize = $fontSize;
        return $this;

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
    public function setTextColor(string $textColor): self
    {
        $this->textColor = $textColor;
        return $this;

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
    public function setPage($page): self
    {
        $this->page = $page;
        return $this;

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
    public function setX($x): self
    {
        $this->x = $x;
        return $this;

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
    public function setY($y): self
    {
        $this->y = $y;
        return $this;

    }
}
