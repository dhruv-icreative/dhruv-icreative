<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComClub\Aggregate\EEComClubTeam;

// TODO: REMOVE OBSOLETE COLLECTION
use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void                add(EEComClubTeamEntity $entity)
 * @method void                set(string $key, EEComClubTeamEntity $entity)
 * @method EEComClubTeamEntity[]    getIterator()
 * @method EEComClubTeamEntity[]    getElements()
 * @method EEComClubTeamEntity|null get(string $key)
 * @method EEComClubTeamEntity|null first()
 * @method EEComClubTeamEntity|null last()
 */

class EEComClubTeamCollection extends EntityCollection
{
    public function getExpectedClass(): string
    {
        return EEComClubTeamEntity::class;
    }
}
