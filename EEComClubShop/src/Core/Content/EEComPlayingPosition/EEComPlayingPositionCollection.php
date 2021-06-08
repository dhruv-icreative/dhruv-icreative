<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComPlayingPosition;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void              add(EEComPlayingPositionEntity $entity)
 * @method void              set(string $key, EEComPlayingPositionEntity $entity)
 * @method EEComPlayingPositionEntity[]    getIterator()
 * @method EEComPlayingPositionEntity[]    getElements()
 * @method EEComPlayingPositionEntity|null get(string $key)
 * @method EEComPlayingPositionEntity|null first()
 * @method EEComPlayingPositionEntity|null last()
 */

class EEComPlayingPositionCollection extends EntityCollection
{
    public function getExpectedClass(): string
    {
        return EEComPlayingPositionEntity::class;
    }
}
