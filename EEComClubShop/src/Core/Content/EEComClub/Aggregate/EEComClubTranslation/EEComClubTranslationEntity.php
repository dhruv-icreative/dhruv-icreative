<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComClub\Aggregate\EEComClubTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\TranslationEntity;
use EECom\ClubShop\Core\Content\EEComClub\EEComClubEntity;

class EEComClubTranslationEntity extends TranslationEntity
{
    /**
     * @var string|null
     */
    protected $eecomClubId;

    /**
     * @var string
     */
    protected $shortName;

    /**
     * @var string|null
     */
    protected $longName;

    /**
     * @var string|null
     */
    protected $fullName;

    /**
     * @var string|null
     */
    protected $department;

    /**
     * @var string|null
     */
    protected $groundName;

    /**
     * @var string|null
     */
    protected $clubDescription;

    /**
     * @var string|null
     */
    protected $metaTitle;

    /**
     * @var string|null
     */
    protected $metaDescription;

    /**
     * @var string|null
     */
    protected $keywords;

    /**
     * @var array|null
     */
    protected $customFields;

    /**
     * @var EEComClubEntity|null
     */
        protected $eecomClub;

    /**
     * @return string|null
     */
    public function getEEComClubId(): ?string
    {
        return $this->eecomClubId;
    }

    /**
     * @param string|null $eecomClubId
     */
    public function setEEComClubId(?string $eecomClubId): void
    {
        $this->eecomClubId = $eecomClubId;
    }

    /**
     * @return string|null
     */
    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName(string $shortName): void
    {
        $this->shortName = $shortName;
    }

    /**
     * @return string|null
     */
    public function getLongName(): ?string
    {
        return $this->longName;
    }

    /**
     * @param string|null $longName
     */
    public function setLongName(?string $longName): void
    {
        $this->longName = $longName;
    }

    /**
     * @return string|null
     */
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    /**
     * @param string|null $fullName
     */
    public function setFullName(?string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string|null
     */
    public function getDepartment(): ?string
    {
        return $this->department;
    }

    /**
     * @param string|null $department
     */
    public function setDepartment(?string $department): void
    {
        $this->department = $department;
    }

    /**
     * @return string|null
     */
    public function getGroundName(): ?string
    {
        return $this->groundName;
    }

    /**
     * @param string|null $groundName
     */
    public function setGroundName(?string $groundName): void
    {
        $this->groundName = $groundName;
    }

    /**
     * @return string|null
     */
    public function getClubDescription(): ?string
    {
        return $this->clubDescription;
    }

    /**
     * @param string|null $clubDescription
     */
    public function setClubDescription(?string $clubDescription): void
    {
        $this->clubDescription = $clubDescription;
    }

    /**
     * @return string|null
     */
    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    /**
     * @param string|null $metaTitle
     */
    public function setMetaTitle(?string $metaTitle): void
    {
        $this->metaTitle = $metaTitle;
    }

    /**
     * @return string|null
     */
    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    /**
     * @param string|null $metaDescription
     */
    public function setMetaDescription(?string $metaDescription): void
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * @return string|null
     */
    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    /**
     * @param string|null $keywords
     */
    public function setKeywords(?string $keywords): void
    {
        $this->keywords = $keywords;
    }

    /**
     * @return array|null
     */
    public function getCustomFields(): ?array
    {
        return $this->customFields;
    }

    /**
     * @param array|null $customFields
     */
    public function setCustomFields(?array $customFields): void
    {
        $this->customFields = $customFields;
    }

    /**
     * @return EEComClubEntity|null
     */
    public function getEecomClub(): ?EEComClubEntity
    {
        return $this->eecomClub;
    }

    /**
     * @param EEComClubEntity|null $eecomClub
     */
    public function setEecomClub(?EEComClubEntity $eecomClub): void
    {
        $this->eecomClub = $eecomClub;
    }
}
