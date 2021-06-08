<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComLeagueRegion;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

class EEComLeagueRegionCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'league_region_collection';
    }

    protected function getExpectedClass(): string
    {
        return EEComLeagueRegionEntity::class;
    }
}
