<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComClub\Aggregate\EEComClubTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

class EEComClubTranslationCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return EEComClubTranslationEntity::class;
    }
}
