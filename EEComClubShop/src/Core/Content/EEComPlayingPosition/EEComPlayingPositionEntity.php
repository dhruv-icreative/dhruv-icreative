<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComPlayingPosition;

use EECom\ClubShop\Core\Content\EEComPlayer\EEComPlayerCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class EEComPlayingPositionEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var EEComPlayerCollection|null
     */
    protected $playersOnePlayingPositions;

    /**
     * @var EEComPlayerCollection|null
     */
    protected $playersTwoPlayingPositions;

    /**
     * @var EEComPlayerCollection|null
     */
    protected $playersTeamPositions;

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
     * @return EEComPlayerCollection|null
     */
    public function getPlayersOnePlayingPositions(): ?EEComPlayerCollection
    {
        return $this->playersOnePlayingPositions;
    }

    /**
     * @param EEComPlayerCollection $playersOnePlayingPositions
     */
    public function setPlayersOnePlayingPositions(EEComPlayerCollection $playersOnePlayingPositions): void
    {
        $this->playersOnePlayingPositions = $playersOnePlayingPositions;
    }

    /**
     * @return EEComPlayerCollection|null
     */
    public function getPlayersTwoPlayingPositions(): ?EEComPlayerCollection
    {
        return $this->playersTwoPlayingPositions;
    }

    /**
     * @param EEComPlayerCollection $playersTwoPlayingPositions
     */
    public function setPlayersTwoPlayingPositions(EEComPlayerCollection $playersTwoPlayingPositions): void
    {
        $this->playersTwoPlayingPositions = $playersTwoPlayingPositions;
    }

    /**
     * @return EEComPlayerCollection|null
     */
    public function getPlayersTeamPositions(): ?EEComPlayerCollection
    {
        return $this->playersTeamPositions;
    }

    /**
     * @param EEComPlayerCollection $playersTeamPositions
     */
    public function setPlayersTeamPositions(EEComPlayerCollection $playersTeamPositions): void
    {
        $this->playersTeamPositions = $playersTeamPositions;
    }
}
