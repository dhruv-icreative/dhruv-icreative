<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use EECom\ClubShop\Core\Content\EEComTeam\EEComTeamEntity;
use Shopware\Core\System\Language\LanguageEntity;

class EEComTeamTranslationEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $groundName;

    /**
     * @var string|null
     */
    protected $teamDescription;

    /**
     * @var array|null
     */
    protected $customFields;

    /**
     * @var string
     */
    protected $eecomTeamId;

    /**
     * @var string
     */
    protected $languageId;

    /**
     * @var EEComTeamEntity|null
     */
    protected $eecomTeam;

    /**
     * @var LanguageEntity|null
     */
    protected $language;

    /**
     * @return string|null
     */
    public function getName(): ?string
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
    public function getTeamDescription(): ?string
    {
        return $this->teamDescription;
    }

    /**
     * @param string|null $teamDescription
     */
    public function setTeamDescription(?string $teamDescription): void
    {
        $this->teamDescription = $teamDescription;
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
     * @return string
     */
    public function getEecomTeamId(): string
    {
        return $this->eecomTeamId;
    }

    /**
     * @param string $eecomTeamId
     */
    public function setEecomTeamId(string $eecomTeamId): void
    {
        $this->eecomTeamId = $eecomTeamId;
    }

    /**
     * @return string
     */
    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    /**
     * @param string $languageId
     */
    public function setLanguageId(string $languageId): void
    {
        $this->languageId = $languageId;
    }

    /**
     * @return EEComTeamEntity|null
     */
    public function getEecomTeam(): ?EEComTeamEntity
    {
        return $this->eecomTeam;
    }

    /**
     * @param EEComTeamEntity|null $eecomTeam
     */
    public function setEecomTeam(?EEComTeamEntity $eecomTeam): void
    {
        $this->eecomTeam = $eecomTeam;
    }

    /**
     * @return LanguageEntity|null
     */
    public function getLanguage(): ?LanguageEntity
    {
        return $this->language;
    }

    /**
     * @param LanguageEntity|null $language
     */
    public function setLanguage(?LanguageEntity $language): void
    {
        $this->language = $language;
    }
}
