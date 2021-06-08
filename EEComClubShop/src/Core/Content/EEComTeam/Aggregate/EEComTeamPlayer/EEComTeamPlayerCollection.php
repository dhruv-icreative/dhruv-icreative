<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamPlayer;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void                add(EEComTeamPlayerEntity $entity)
 * @method void                set(string $key, EEComTeamPlayerEntity $entity)
 * @method EEComTeamPlayerEntity[]    getIterator()
 * @method EEComTeamPlayerEntity[]    getElements()
 * @method EEComTeamPlayerEntity|null get(string $key)
 * @method EEComTeamPlayerEntity|null first()
 * @method EEComTeamPlayerEntity|null last()
 */

class EEComTeamPlayerCollection extends EntityCollection
{
    public function getExpectedClass(): string
    {
        return EEComTeamPlayerEntity::class;
    }
}
