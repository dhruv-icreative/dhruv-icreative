<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComLeague;

use EECom\ClubShop\Core\Content\EEComTeam\EEComTeamCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class EEComLeagueEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var EEComTeamCollection|null
     */
    protected $teams;

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
     * @return EEComTeamCollection|null
     */
    public function getTeams(): ?EEComTeamCollection
    {
        return $this->teams;
    }

    /**
     * @param EEComTeamCollection $teams
     */
    public function setTeams(EEComTeamCollection $teams): void
    {
        $this->teams = $teams;
    }
}
