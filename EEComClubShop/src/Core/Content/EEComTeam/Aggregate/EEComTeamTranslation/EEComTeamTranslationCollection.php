<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

class EEComTeamTranslationCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return EEComTeamTranslationEntity::class;
    }
}
