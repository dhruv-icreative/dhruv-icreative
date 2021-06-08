<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamPlayer;

use EECom\ClubShop\Core\Content\EEComPlayer\EEComPlayerDefinition;
use EECom\ClubShop\Core\Content\EEComTeam\EEComTeamDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class EEComTeamPlayerDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'eecom_team_player';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return EEComTeamPlayerCollection::class;
    }

    public function getEntityClass(): string
    {
        return EEComTeamPlayerEntity::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
            (new FkField('eecom_team_id', 'eecomTeamId', EEComTeamDefinition::class, 'id'))->addFlags(new Required()),
            (new FkField('eecom_player_id', 'eecomPlayerId', EEComPlayerDefinition::class, 'id'))->addFlags(new Required()),
            new ManyToOneAssociationField('team', 'eecom_team_id', EEComTeamDefinition::class, 'id', false),
            new OneToOneAssociationField('player', 'eecom_player_id', 'id', EEComPlayerDefinition::class, false),
        ]);
    }
}
