<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamPlayer;

use EECom\ClubShop\Core\Content\EEComPlayer\EEComPlayerEntity;
use EECom\ClubShop\Core\Content\EEComTeam\EEComTeamEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class EEComTeamPlayerEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $eecomTeamId;

    /**
     * @var string
     */
    protected $eecomPlayerId;

    /**
     * @var EEComTeamEntity|null
     */
    protected $team;

    /**
     * @var EEComPlayerEntity|null
     */
    protected $player;

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
    public function getEecomPlayerId(): string
    {
        return $this->eecomPlayerId;
    }

    /**
     * @param string $eecomPlayerId
     */
    public function setEecomPlayerId(string $eecomPlayerId): void
    {
        $this->eecomPlayerId = $eecomPlayerId;
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
     * @return EEComPlayerEntity|null
     */
    public function getPlayer(): ?EEComPlayerEntity
    {
        return $this->player;
    }

    /**
     * @param EEComPlayerEntity|null $player
     */
    public function setPlayer(?EEComPlayerEntity $player): void
    {
        $this->player = $player;
    }
}
