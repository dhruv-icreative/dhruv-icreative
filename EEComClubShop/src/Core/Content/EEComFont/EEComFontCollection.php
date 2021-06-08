<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComFont;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void              add(EEComFontEntity $entity)
 * @method void              set(string $key, EEComFontEntity $entity)
 * @method EEComFontEntity[]    getIterator()
 * @method EEComFontEntity[]    getElements()
 * @method EEComFontEntity|null get(string $key)
 * @method EEComFontEntity|null first()
 * @method EEComFontEntity|null last()
 */

class EEComFontCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'font_collection';
    }

    public function getExpectedClass(): string
    {
        return EEComFontEntity::class;
    }
}
