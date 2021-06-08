<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComTeam;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void                add(EEComTeamEntity $entity)
 * @method void                set(string $key, EEComTeamEntity $entity)
 * @method EEComTeamEntity[]    getIterator()
 * @method EEComTeamEntity[]    getElements()
 * @method EEComTeamEntity|null get(string $key)
 * @method EEComTeamEntity|null first()
 * @method EEComTeamEntity|null last()
 */

class EEComTeamCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'team_collection';
    }

    protected function getExpectedClass(): string
    {
        return EEComTeamEntity::class;
    }
}
