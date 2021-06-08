<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComTeam;

use EECom\ClubShop\Core\Content\EEComClub\Aggregate\EEComClubTeam\EEComClubTeamDefinition;
use EECom\ClubShop\Core\Content\EEComLeague\EEComLeagueDefinition;
use EECom\ClubShop\Core\Content\EEComLeagueRegion\EEComLeagueRegionDefinition;
use EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamMedia\EEComTeamMediaDefinition;
use EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamPlayer\EEComTeamPlayerDefinition;
use EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamProduct\EEComTeamProductDefinition;
use EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamTranslation\EEComTeamTranslationDefinition;
use Shopware\Core\Content\Category\CategoryDefinition;
use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Content\ProductStream\ProductStreamDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\CascadeDelete;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ReferenceVersionField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class EEComTeamDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'eecom_team';

    public const PROFESSION_TYPE = 'amateur';

    public const SPORT_TYPE = 'football';

    public const TEAM_TYPE = 'men';

    public const PRODUCT_ASSIGNMENT_TYPE_PRODUCT = 'product';

    public const PRODUCT_ASSIGNMENT_TYPE_PRODUCT_STREAM = 'product_stream';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return EEComTeamEntity::class;
    }

    public function getCollectionClass(): string
    {
        return EEComTeamCollection::class;
    }

    public function getDefaults(): array
    {
        return [
            'profession' => self::PROFESSION_TYPE,
            'sportType' => self::SPORT_TYPE,
            'teamType' => self::TEAM_TYPE,
            'productAssignmentType' => self::PRODUCT_ASSIGNMENT_TYPE_PRODUCT,
            'active' => true,
        ];
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
            (new FkField('category_id', 'categoryId', CategoryDefinition::class, 'id'))->addFlags(new Required()),
            new ReferenceVersionField(CategoryDefinition::class),
            new TranslatedField('name'),
            new BoolField('active', 'active'),
            (new StringField('profession', 'profession'))->addFlags(new Required()),
            (new StringField('sport_type', 'sportType'))->addFlags(new Required()),
            (new StringField('team_type', 'teamType'))->addFlags(new Required()),
            new FkField('league_id', 'leagueId', EEComLeagueDefinition::class, 'id'),
            new FkField('league_region_id', 'leagueRegionId', EEComLeagueRegionDefinition::class, 'id'),
            new TranslatedField('groundName'),
            new TranslatedField('teamDescription'),
            (new StringField('product_assignment_type', 'productAssignmentType'))->addFlags(new Required()),
            new FkField('product_stream_id', 'productStreamId', ProductStreamDefinition::class),
            new FkField('media_id', 'coverId', MediaDefinition::class, 'id'),
            new FkField('teaser_product_id', 'teaserProductId', ProductDefinition::class, 'id'),
            new ReferenceVersionField(ProductDefinition::class),
            new TranslatedField('customFields'),
            new TranslationsAssociationField(EEComTeamTranslationDefinition::class, 'eecom_team_id'),
            new ManyToOneAssociationField('category', 'category_id', CategoryDefinition::class, 'id'),
            new ManyToOneAssociationField('productStream', 'product_stream_id', ProductStreamDefinition::class, 'id', false),
            new ManyToOneAssociationField('cover', 'media_id', MediaDefinition::class, 'id'),
            (new ManyToManyAssociationField('media', MediaDefinition::class, EEComTeamMediaDefinition::class, 'eecom_team_id', 'media_id'))->addFlags(new CascadeDelete()),
            new ManyToManyAssociationField('products', ProductDefinition::class, EEComTeamProductDefinition::class, 'eecom_team_id', 'product_id'),
            // TODO: directly associate EEComClubDefinition
            new OneToOneAssociationField('teamClub', 'id', 'eecom_team_id', EEComClubTeamDefinition::class),
            new ManyToOneAssociationField('league', 'league_id', EEComLeagueDefinition::class, 'id'),
            new ManyToOneAssociationField('leagueRegion', 'league_region_id', EEComLeagueRegionDefinition::class, 'id'),
            (new OneToManyAssociationField('players', EEComTeamPlayerDefinition::class, 'eecom_team_id', 'id'))->addFlags(new CascadeDelete()),
            new ManyToOneAssociationField('teaserProduct', 'teaser_product_id', ProductDefinition::class, 'id')
        ]);
    }
}
