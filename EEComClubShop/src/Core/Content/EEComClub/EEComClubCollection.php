<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComClub;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void              add(EEComClubEntity $entity)
 * @method void              set(string $key, EEComClubEntity $entity)
 * @method EEComClubEntity[]    getIterator()
 * @method EEComClubEntity[]    getElements()
 * @method EEComClubEntity|null get(string $key)
 * @method EEComClubEntity|null first()
 * @method EEComClubEntity|null last()
 */

class EEComClubCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'club_collection';
    }

    protected function getExpectedClass(): string
    {
        return EEComClubEntity::class;
    }
}
