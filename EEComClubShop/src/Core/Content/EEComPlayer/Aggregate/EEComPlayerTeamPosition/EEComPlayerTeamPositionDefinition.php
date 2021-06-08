<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComPlayer\Aggregate\EEComPlayerTeamPosition;

use EECom\ClubShop\Core\Content\EEComPlayer\EEComPlayerDefinition;
use EECom\ClubShop\Core\Content\EEComPlayingPosition\EEComPlayingPositionDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\MappingEntityDefinition;

class EEComPlayerTeamPositionDefinition extends MappingEntityDefinition
{
    public const ENTITY_NAME = 'eecom_player_team_position';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new FkField('eecom_player_id', 'eecomPlayerId', EEComPlayerDefinition::class, 'id'))->addFlags(new PrimaryKey(), new Required()),
            (new FkField('eecom_playing_position_id', 'eecomPlayingPositionId', EEComPlayingPositionDefinition::class, 'id'))->addFlags(new PrimaryKey(), new Required()),
            new ManyToOneAssociationField('player', 'eecom_player_id', EEComPlayerDefinition::class, 'id'),
            new ManyToOneAssociationField('teamPosition', 'eecom_playing_position_id', EEComPlayingPositionDefinition::class, 'id')
        ]);
    }
}
