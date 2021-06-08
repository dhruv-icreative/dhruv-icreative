<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComLeague;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

class EEComLeagueCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'league_collection';
    }

    public function getExpectedClass(): string
    {
        return EEComLeagueEntity::class;
    }
}
