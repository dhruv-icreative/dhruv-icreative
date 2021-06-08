<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComClub;

use EECom\ClubShop\Core\Content\EEComClub\Aggregate\EEComClubMedia\EEComClubMediaDefinition;
use EECom\ClubShop\Core\Content\EEComClub\Aggregate\EEComClubTeam\EEComClubTeamDefinition;
use EECom\ClubShop\Core\Content\EEComClub\Aggregate\EEComClubTranslation\EEComClubTranslationDefinition;
use EECom\ClubShop\Core\Content\EEComFont\EEComFontDefinition;
use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Content\Seo\SeoUrl\SeoUrlDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\CascadeDelete;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IntField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Country\CountryDefinition;

class EEComClubDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'eecom_club';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return EEComClubEntity::class;
    }

    public function getCollectionClass(): string
    {
        return EEComClubCollection::class;
    }

    public function getDefaults(): array
    {
        return [
            'active' => true
        ];
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
            new FkField('logo_square_id', 'logoSquareId', MediaDefinition::class),
            new FkField('logo_landscape_id', 'logoLandscapeId', MediaDefinition::class),
            new TranslatedField('shortName'),
            new TranslatedField('longName'),
            new TranslatedField('fullName'),
            new TranslatedField('department'),
            (new StringField('street', 'street')),
            (new IntField('number', 'number')),
            (new StringField('zipcode', 'zipcode')),
            (new StringField('city', 'city')),
            (new FkField('country_id', 'countryId', CountryDefinition::class))->addFlags(new Required()),
            (new StringField('phone_number', 'phoneNumber')),
            (new StringField('contact_person', 'contactPerson')),
            (new StringField('email', 'email')),
            (new StringField('club_website1', 'clubWebsite1')),
            (new StringField('club_website2', 'clubWebsite2')),
            (new StringField('club_news', 'clubNews')),
            (new StringField('facebook_url', 'facebookUrl')),
            new TranslatedField('groundName'),
            new TranslatedField('clubDescription'),
            new FkField('media_id', 'coverId', MediaDefinition::class),
            new TranslatedField('metaTitle'),
            new TranslatedField('metaDescription'),
            new TranslatedField('keywords'),
            new StringField('club_color_primary', 'clubColorPrimary'),
            new StringField('club_color_secondary', 'clubColorSecondary'),
            new StringField('club_color_optional', 'clubColorOptional'),
            new StringField('background_color', 'backgroundColor'),
            new StringField('club_shop_design', 'clubShopDesign'),
            new FkField('headline_font_id', 'headlineFontId', EEComFontDefinition::class, 'id'),
            new FkField('text_font_id', 'textFontId', EEComFontDefinition::class, 'id'),
            (new BoolField('active', 'active')),
            new TranslatedField('customFields'),
            new TranslationsAssociationField(EEComClubTranslationDefinition::class, 'eecom_club_id'),
            new ManyToOneAssociationField('clubLogoSquare', 'logo_square_id', MediaDefinition::class, 'id'),
            new ManyToOneAssociationField('clubLogoLandscape', 'logo_landscape_id', MediaDefinition::class, 'id'),
            (new ManyToOneAssociationField('cover', 'media_id', MediaDefinition::class, 'id')),
            (new ManyToManyAssociationField('media', MediaDefinition::class, EEComClubMediaDefinition::class, 'eecom_club_id', 'media_id'))->addFlags(new CascadeDelete()),
            // TODO: directly associate EEComTeamDefinition
            (new OneToManyAssociationField('teams', EEComClubTeamDefinition::class, 'eecom_club_id', 'id'))->addFlags(new CascadeDelete()),
            (new ManyToOneAssociationField('country', 'country_id', CountryDefinition::class, 'id', false))->addFlags(),
            new ManyToOneAssociationField('headlineFont', 'headline_font_id', EEComFontDefinition::class, 'id'),
            new ManyToOneAssociationField('textFont', 'text_font_id', EEComFontDefinition::class, 'id'),
            new OneToManyAssociationField('seoUrls', SeoUrlDefinition::class, 'foreign_key')
        ]);
    }
}
