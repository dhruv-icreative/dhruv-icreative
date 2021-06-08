<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComClub;

use EECom\ClubShop\Core\Content\EEComClub\Aggregate\EEComClubTeam\EEComClubTeamCollection;
use EECom\ClubShop\Core\Content\EEComFont\EEComFontEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use EECom\ClubShop\Core\Content\EEComClub\Aggregate\EEComClubTranslation\EEComClubTranslationCollection;
use Shopware\Core\System\Country\CountryEntity;
use Shopware\Core\Content\Media\MediaCollection;
use Shopware\Core\Content\Media\MediaEntity;
use Shopware\Core\Content\Seo\SeoUrl\SeoUrlCollection;

class EEComClubEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $countryId;

    /**
     * @var string
     */
    protected $logoSquareId;

    /**
     * @var string|null
     */
    protected $logoLandscapeId;

    /**
     * @var string|null
     */
    protected $shortName;

    /**
     * @var string|null
     */
    protected $longName;

    /**
     * @var string|null
     */
    protected $fullName;

    /**
     * @var string|null
     */
    protected $department;

    /**
     * @var string|null
     */
    protected $street;

    /**
     * @var int|null
     */
    protected $number;

    /**
     * @var string|null
     */
    protected $zipcode;

    /**
     * @var string|null
     */
    protected $city;

    /**
     * @var CountryEntity|null
     */
    protected $country;

    /**
     * @var string|null
     */
    protected $phoneNumber;

    /**
     * @var string|null
     */
    protected $contactPerson;

    /**
     * @var string|null
     */
    protected $email;

    /**
     * @var string|null
     */
    protected $clubWebsite1;

    /**
     * @var string|null
     */
    protected $clubWebsite2;

    /**
     * @var string|null
     */
    protected $clubNews;

    /**
     * @var string|null
     */
    protected $facebookUrl;

    /**
     * @var string|null
     */
    protected $groundName;

    /**
     * @var string|null
     */
    protected $clubDescription;

    /**
     * @var string|null
     */
    protected $coverId;

    /**
     * @var MediaEntity|null
     */
    protected $cover;

    /**
     * @var MediaCollection|null
     */
    protected $media;

    /**
     * @var string|null
     */
    protected $metaTitle;

    /**
     * @var string|null
     */
    protected $metaDescription;

    /**
     * @var string|null
     */
    protected $keywords;

    /**
     * @var EEComClubTranslationCollection|null
     */
    protected $translations;

    /**
     * @var string|null
     */
    protected $clubColorPrimary;

    /**
     * @var string|null
     */
    protected $clubColorSecondary;

    /**
     * @var string|null
     */
    protected $clubColorOptional;

    /**
     * @var string|null
     */
    protected $backgroundColor;

    /**
     * @var string|null
     */
    protected $clubShopDesign;

    /**
     * @var string|null
     */
    protected $headlineFontId;

    /**
     * @var string|null
     */
    protected $textFontId;

    /**
     * @var bool
     */
    protected $active;

    /**
     * @var array|null
     */
    protected $customFields;

    /**
     * @var MediaEntity|null
     */
    protected $clubLogoSquare;

    /**
     * @var MediaEntity|null
     */
    protected $clubLogoLandscape;

    /**
     * @var EEComClubTeamCollection|null
     */
    protected $teams;

    /**
     * @var EEComFontEntity|null
     */
    protected $headlineFont;

    /**
     * @var EEComFontEntity|null
     */
    protected $textFont;

    /**
     * @var SeoUrlCollection|null
     */
    protected $seoUrls;

    /**
     * @return string
     */
    public function getCountryId(): string
    {
        return $this->countryId;
    }

    /**
     * @param string $countryId
     */
    public function setCountryId(string $countryId): void
    {
        $this->countryId = $countryId;
    }

    /**
     * @return string
     */
    public function getLogoSquareId(): string
    {
        return $this->logoSquareId;
    }

    /**
     * @param string $logoSquareId
     */
    public function setLogoSquareId(string $logoSquareId): void
    {
        $this->logoSquareId = $logoSquareId;
    }

    /**
     * @return string|null
     */
    public function getLogoLandscapeId(): ?string
    {
        return $this->logoLandscapeId;
    }

    /**
     * @param string|null $logoLandscapeId
     */
    public function setLogoLandscapeId(?string $logoLandscapeId): void
    {
        $this->logoLandscapeId = $logoLandscapeId;
    }

    /**
     * @return string|null
     */
    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    /**
     * @param string|null $shortName
     */
    public function setShortName(?string $shortName): void
    {
        $this->shortName = $shortName;
    }

    /**
     * @return string|null
     */
    public function getLongName(): ?string
    {
        return $this->longName;
    }

    /**
     * @param string|null $longName
     */
    public function setLongName(?string $longName): void
    {
        $this->longName = $longName;
    }

    /**
     * @return string|null
     */
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    /**
     * @param string|null $fullName
     */
    public function setFullName(?string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string|null
     */
    public function getDepartment(): ?string
    {
        return $this->department;
    }

    /**
     * @param string|null $department
     */
    public function setDepartment(?string $department): void
    {
        $this->department = $department;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     */
    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return int|null
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param int|null $number
     */
    public function setNumber(?int $number): void
    {
        $this->number = $number;
    }

    /**
     * @return string|null
     */
    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    /**
     * @param string|null $zipcode
     */
    public function setZipcode(?string $zipcode): void
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return CountryEntity|null
     */
    public function getCountry(): ?CountryEntity
    {
        return $this->country;
    }

    /**
     * @param CountryEntity|null $country
     */
    public function setCountry(?CountryEntity $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string|null $phoneNumber
     */
    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string|null
     */
    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }

    /**
     * @param string|null $contactPerson
     */
    public function setContactPerson(?string $contactPerson): void
    {
        $this->contactPerson = $contactPerson;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getClubWebsite1(): ?string
    {
        return $this->clubWebsite1;
    }

    /**
     * @param string|null $clubWebsite1
     */
    public function setClubWebsite1(?string $clubWebsite1): void
    {
        $this->clubWebsite1 = $clubWebsite1;
    }

    /**
     * @return string|null
     */
    public function getClubWebsite2(): ?string
    {
        return $this->clubWebsite2;
    }

    /**
     * @param string|null $clubWebsite2
     */
    public function setClubWebsite2(?string $clubWebsite2): void
    {
        $this->clubWebsite2 = $clubWebsite2;
    }

    /**
     * @return string|null
     */
    public function getClubNews(): ?string
    {
        return $this->clubNews;
    }

    /**
     * @param string|null $clubNews
     */
    public function setClubNews(?string $clubNews): void
    {
        $this->clubNews = $clubNews;
    }

    /**
     * @return string|null
     */
    public function getFacebookUrl(): ?string
    {
        return $this->facebookUrl;
    }

    /**
     * @param string|null $facebookUrl
     */
    public function setFacebookUrl(?string $facebookUrl): void
    {
        $this->facebookUrl = $facebookUrl;
    }

    /**
     * @return string|null
     */
    public function getGroundName(): ?string
    {
        return $this->groundName;
    }

    /**
     * @param string|null $groundName
     */
    public function setGroundName(?string $groundName): void
    {
        $this->groundName = $groundName;
    }

    /**
     * @return string|null
     */
    public function getClubDescription(): ?string
    {
        return $this->clubDescription;
    }

    /**
     * @param string|null $clubDescription
     */
    public function setClubDescription(?string $clubDescription): void
    {
        $this->clubDescription = $clubDescription;
    }

    /**
     * @return string|null
     */
    public function getCoverId(): ?string
    {
        return $this->coverId;
    }

    /**
     * @param string|null $coverId
     */
    public function setCoverId(?string $coverId): void
    {
        $this->coverId = $coverId;
    }

    /**
     * @return MediaEntity|null
     */
    public function getCover(): ?MediaEntity
    {
        return $this->cover;
    }

    /**
     * @param MediaEntity|null $cover
     */
    public function setCover(?MediaEntity $cover): void
    {
        $this->cover = $cover;
    }

    /**
     * @return MediaCollection|null
     */
    public function getMedia(): ?MediaCollection
    {
        return $this->media;
    }

    /**
     * @param MediaCollection $media
     */
    public function setMedia(MediaCollection $media): void
    {
        $this->media = $media;
    }

    /**
     * @return string|null
     */
    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    /**
     * @param string|null $metaTitle
     */
    public function setMetaTitle(?string $metaTitle): void
    {
        $this->metaTitle = $metaTitle;
    }

    /**
     * @return string|null
     */
    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    /**
     * @param string|null $metaDescription
     */
    public function setMetaDescription(?string $metaDescription): void
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * @return string|null
     */
    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    /**
     * @param string|null $keywords
     */
    public function setKeywords(?string $keywords): void
    {
        $this->keywords = $keywords;
    }

    /**
     * @return EEComClubTranslationCollection|null
     */
    public function getTranslations(): ?EEComClubTranslationCollection
    {
        return $this->translations;
    }

    /**
     * @param EEComClubTranslationCollection $translations
     */
    public function setTranslations(EEComClubTranslationCollection $translations): void
    {
        $this->translations = $translations;
    }

    /**
     * @return string|null
     */
    public function getClubColorPrimary(): ?string
    {
        return $this->clubColorPrimary;
    }

    /**
     * @param string|null $clubColorPrimary
     */
    public function setClubColorPrimary(?string $clubColorPrimary): void
    {
        $this->clubColorPrimary = $clubColorPrimary;
    }

    /**
     * @return string|null
     */
    public function getClubColorSecondary(): ?string
    {
        return $this->clubColorSecondary;
    }

    /**
     * @param string|null $clubColorSecondary
     */
    public function setClubColorSecondary(?string $clubColorSecondary): void
    {
        $this->clubColorSecondary = $clubColorSecondary;
    }

    /**
     * @return string|null
     */
    public function getClubColorOptional(): ?string
    {
        return $this->clubColorOptional;
    }

    /**
     * @param string|null $clubColorOptional
     */
    public function setClubColorOptional(?string $clubColorOptional): void
    {
        $this->clubColorOptional = $clubColorOptional;
    }

    /**
     * @return string|null
     */
    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    /**
     * @param string|null $backgroundColor
     */
    public function setBackgroundColor(?string $backgroundColor): void
    {
        $this->backgroundColor = $backgroundColor;
    }

    /**
     * @return string|null
     */
    public function getClubShopDesign(): ?string
    {
        return $this->clubShopDesign;
    }

    /**
     * @param string|null $clubShopDesign
     */
    public function setClubShopDesign(?string $clubShopDesign): void
    {
        $this->clubShopDesign = $clubShopDesign;
    }

    /**
     * @return string|null
     */
    public function getHeadlineFontId(): ?string
    {
        return $this->headlineFontId;
    }

    /**
     * @param string|null $headlineFontId
     */
    public function setHeadlineFontId(?string $headlineFontId): void
    {
        $this->headlineFontId = $headlineFontId;
    }

    /**
     * @return string|null
     */
    public function getTextFontId(): ?string
    {
        return $this->textFontId;
    }

    /**
     * @param string|null $textFontId
     */
    public function setTextFontId(?string $textFontId): void
    {
        $this->textFontId = $textFontId;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return array|null
     */
    public function getCustomFields(): ?array
    {
        return $this->customFields;
    }

    /**
     * @param array|null $customFields
     */
    public function setCustomFields(?array $customFields): void
    {
        $this->customFields = $customFields;
    }

    /**
     * @return MediaEntity|null
     */
    public function getClubLogoSquare(): ?MediaEntity
    {
        return $this->clubLogoSquare;
    }

    /**
     * @param MediaEntity|null $clubLogoSquare
     */
    public function setClubLogoSquare(?MediaEntity $clubLogoSquare): void
    {
        $this->clubLogoSquare = $clubLogoSquare;
    }

    /**
     * @return MediaEntity|null
     */
    public function getClubLogoLandscape(): ?MediaEntity
    {
        return $this->clubLogoLandscape;
    }

    /**
     * @param MediaEntity|null $clubLogoLandscape
     */
    public function setClubLogoLandscape(?MediaEntity $clubLogoLandscape): void
    {
        $this->clubLogoLandscape = $clubLogoLandscape;
    }

    /**
     * @return EEComClubTeamCollection|null
     */
    public function getTeams(): ?EEComClubTeamCollection
    {
        return $this->teams;
    }

    /**
     * @param EEComClubTeamCollection $teams
     */
    public function setTeams(EEComClubTeamCollection $teams): void
    {
        $this->teams = $teams;
    }

    /**
     * @return EEComFontEntity|null
     */
    public function getHeadlineFont(): ?EEComFontEntity
    {
        return $this->headlineFont;
    }

    /**
     * @param EEComFontEntity|null $headlineFont
     */
    public function setHeadlineFont(?EEComFontEntity $headlineFont): void
    {
        $this->headlineFont = $headlineFont;
    }

    /**
     * @return EEComFontEntity|null
     */
    public function getTextFont(): ?EEComFontEntity
    {
        return $this->textFont;
    }

    /**
     * @param EEComFontEntity|null $textFont
     */
    public function setTextFont(?EEComFontEntity $textFont): void
    {
        $this->textFont = $textFont;
    }

    /**
     * @return SeoUrlCollection|null
     */
    public function getSeoUrls(): ?SeoUrlCollection
    {
        return $this->seoUrls;
    }

    /**
     * @param SeoUrlCollection $seoUrls
     */
    public function setSeoUrls(SeoUrlCollection $seoUrls): void
    {
        $this->seoUrls = $seoUrls;
    }
}
