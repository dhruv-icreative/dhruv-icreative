<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComClub\Aggregate\EEComClubTeam;

// TODO: REMOVE OBSOLETE ENTITY
use EECom\ClubShop\Core\Content\EEComClub\EEComClubEntity;
use EECom\ClubShop\Core\Content\EEComTeam\EEComTeamEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class EEComClubTeamEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $eecomClubId;

    /**
     * @var string
     */
    protected $eecomTeamId;

    /**
     * @var EEComClubEntity|null
     */
    protected $club;

    /**
     * @return string
     */
    public function getEecomClubId(): string
    {
        return $this->eecomClubId;
    }

    /**
     * @param string $eecomClubId
     */
    public function setEecomClubId(string $eecomClubId): void
    {
        $this->eecomClubId = $eecomClubId;
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
     * @return EEComClubEntity|null
     */
    public function getClub(): ?EEComClubEntity
    {
        return $this->club;
    }

    /**
     * @param EEComClubEntity|null $club
     */
    public function setClub(?EEComClubEntity $club): void
    {
        $this->club = $club;
    }

    /**
     * @return EEComTeamEntity|null
     */
    public function getTeam(): ?EEComTeamEntity
    {
        return $this->team;
    }

    /**
     * @param EEComTeamEntity|null $team
     */
    public function setTeam(?EEComTeamEntity $team): void
    {
        $this->team = $team;
    }

    /**
     * @var EEComTeamEntity|null
     */
    protected $team;
}
