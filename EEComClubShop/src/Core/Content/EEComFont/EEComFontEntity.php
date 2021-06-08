<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComFont;

use EECom\ClubShop\Core\Content\EEComClub\EEComClubCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class EEComFontEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $fontUrl;

    /**
     * @var string|null
     */
    protected $fileName;

    /**
     * @var string|null
     */
    protected $fileType;

    /**
     * @var EEComClubCollection|null
     */
    protected $headlineFontClubs;

    /**
     * @var EEComClubCollection|null
     */
    protected $textFontClubs;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getFontUrl(): ?string
    {
        return $this->fontUrl;
    }

    /**
     * @param string|null $fontUrl
     */
    public function setFontUrl(?string $fontUrl): void
    {
        $this->fontUrl = $fontUrl;
    }

    /**
     * @return string|null
     */
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * @param string|null $fileName
     */
    public function setFileName(?string $fileName): void
    {
        $this->fileName = $fileName;
    }

    /**
     * @return string|null
     */
    public function getFileType(): ?string
    {
        return $this->fileType;
    }

    /**
     * @param string|null $fileType
     */
    public function setFileType(?string $fileType): void
    {
        $this->fileType = $fileType;
    }

    /**
     * @return EEComClubCollection|null
     */
    public function getHeadlineFontClubs(): ?EEComClubCollection
    {
        return $this->headlineFontClubs;
    }

    /**
     * @param EEComClubCollection $headlineFontClubs
     */
    public function setHeadlineFontClubs(EEComClubCollection $headlineFontClubs): void
    {
        $this->headlineFontClubs = $headlineFontClubs;
    }

    /**
     * @return EEComClubCollection|null
     */
    public function getTextFontClubs(): ?EEComClubCollection
    {
        return $this->textFontClubs;
    }

    /**
     * @param EEComClubCollection $textFontClubs
     */
    public function setTextFontClubs(EEComClubCollection $textFontClubs): void
    {
        $this->textFontClubs = $textFontClubs;
    }
}
