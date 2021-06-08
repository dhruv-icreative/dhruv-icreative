<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComPlayingPosition;

use EECom\ClubShop\Core\Content\EEComPlayer\Aggregate\EEComPlayerPlayingPosition1\EEComPlayerPlayingPosition1Definition;
use EECom\ClubShop\Core\Content\EEComPlayer\Aggregate\EEComPlayerPlayingPosition2\EEComPlayerPlayingPosition2Definition;
use EECom\ClubShop\Core\Content\EEComPlayer\Aggregate\EEComPlayerTeamPosition\EEComPlayerTeamPositionDefinition;
use EECom\ClubShop\Core\Content\EEComPlayer\EEComPlayerDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class EEComPlayingPositionDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'eecom_playing_position';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return EEComPlayingPositionCollection::class;
    }

    public function getEntityClass(): string
    {
        return EEComPlayingPositionEntity::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
            (new StringField('name', 'name'))->addFlags(new Required()),
            new ManyToManyAssociationField('playersOnePlayingPositions', EEComPlayerDefinition::class, EEComPlayerPlayingPosition1Definition::class, 'eecom_playing_position_id', 'eecom_player_id'),
            new ManyToManyAssociationField('playersTwoPlayingPositions', EEComPlayerDefinition::class, EEComPlayerPlayingPosition2Definition::class, 'eecom_playing_position_id', 'eecom_player_id'),
            new ManyToManyAssociationField('playersTeamPositions', EEComPlayerDefinition::class, EEComPlayerTeamPositionDefinition::class, 'eecom_playing_position_id', 'eecom_player_id'),
        ]);
    }
}
