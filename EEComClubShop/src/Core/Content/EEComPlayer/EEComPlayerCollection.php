<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComPlayer;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void              add(EEComPlayerEntity $entity)
 * @method void              set(string $key, EEComPlayerEntity $entity)
 * @method EEComPlayerEntity[]    getIterator()
 * @method EEComPlayerEntity[]    getElements()
 * @method EEComPlayerEntity|null get(string $key)
 * @method EEComPlayerEntity|null first()
 * @method EEComPlayerEntity|null last()
 */

class EEComPlayerCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'player_collection';
    }

    protected function getExpectedClass(): string
    {
        return EEComPlayerEntity::class;
    }
}
