<?php declare(strict_types=1);

namespace EECom\ClubShop\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\InheritanceUpdaterTrait;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1618315698 extends MigrationStep
{
    use InheritanceUpdaterTrait;

    public function getCreationTimestamp(): int
    {
        return 1618315698;
    }

    public function update(Connection $connection): void
    {
        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_font` (
                `id` BINARY(16) NOT NULL,
                `name` VARCHAR(255) NOT NULL,
                `font_url` VARCHAR(255) NULL,
                `file_name` VARCHAR(255) NULL,
                `file_type` VARCHAR(255) NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_club` (
                `id` BINARY(16) NOT NULL,
                `logo_square_id` BINARY(16) NULL,
                `logo_landscape_id` BINARY(16) NULL,
                `street` VARCHAR(255) NULL,
                `number` INT(11) NULL,
                `zipcode` VARCHAR(255) NULL,
                `city` VARCHAR(255) NULL,
                `country_id` BINARY(16) NOT NULL,
                `phone_number` VARCHAR(255) NULL,
                `contact_person` VARCHAR(255) NULL,
                `email` VARCHAR(255) NULL,
                `club_website1` VARCHAR(255) NULL,
                `club_website2` VARCHAR(255) NULL,
                `club_news` VARCHAR(255) NULL,
                `facebook_url` VARCHAR(255) NULL,
                `media_id` BINARY(16) NULL,
                `club_color_primary` VARCHAR(255) NULL,
                `club_color_secondary` VARCHAR(255) NULL,
                `club_color_optional` VARCHAR(255) NULL,
                `background_color` VARCHAR(255) NULL,
                `club_shop_design` VARCHAR(255) NULL,
                `headline_font_id` BINARY(16) NULL,
                `text_font_id` BINARY(16) NULL,
                `active` TINYINT(1) NOT NULL DEFAULT 1,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`),
                CONSTRAINT `json.eecom_club.translated` CHECK (JSON_VALID(`translated`)),
                KEY `fk.eecom_club.logo_square_id` (`logo_square_id`),
                KEY `fk.eecom_club.logo_landscape_id` (`logo_landscape_id`),
                KEY `fk.eecom_club.media_id` (`media_id`),
                KEY `fk.eecom_club.country_id` (`country_id`),
                KEY `fk.eecom_club.headline_font_id` (`headline_font_id`),
                KEY `fk.eecom_club.text_font_id` (`text_font_id`),
                CONSTRAINT `fk.eecom_club.logo_square_id` FOREIGN KEY (`logo_square_id`) REFERENCES `media` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_club.logo_landscape_id` FOREIGN KEY (`logo_landscape_id`) REFERENCES `media` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_club.media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_club.country_id` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_club.headline_font_id` FOREIGN KEY (`headline_font_id`) REFERENCES `eecom_font` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_club.text_font_id` FOREIGN KEY (`text_font_id`) REFERENCES `eecom_font` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_club_translation` (
                `short_name` VARCHAR(255) NULL,
                `long_name` VARCHAR(255) NULL,
                `full_name` VARCHAR(255) NULL,
                `department` VARCHAR(255) NULL,
                `ground_name` VARCHAR(255) NULL,
                `club_description` LONGTEXT NULL,
                `meta_title` VARCHAR(255) NULL,
                `meta_description` VARCHAR(255) NULL,
                `keywords` LONGTEXT NULL,
                `custom_fields` JSON NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                `eecom_club_id` BINARY(16) NOT NULL,
                `language_id` BINARY(16) NOT NULL,
                PRIMARY KEY (`eecom_club_id`,`language_id`),
                CONSTRAINT `json.eecom_club_translation.custom_fields` CHECK (JSON_VALID(`custom_fields`)),
                KEY `fk.eecom_club_translation.eecom_club_id` (`eecom_club_id`),
                KEY `fk.eecom_club_translation.language_id` (`language_id`),
                CONSTRAINT `fk.eecom_club_translation.eecom_club_id` FOREIGN KEY (`eecom_club_id`) REFERENCES `eecom_club` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_club_translation.language_id` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_club_media` (
                `eecom_club_id` BINARY(16) NOT NULL,
                `media_id` BINARY(16) NOT NULL,
                `created_at` DATETIME(3) NOT NULL,
                PRIMARY KEY (`eecom_club_id`,`media_id`),
                KEY `fk.eecom_club_media.eecom_club_id` (`eecom_club_id`),
                KEY `fk.eecom_club_media.media_id` (`media_id`),
                CONSTRAINT `fk.eecom_club_media.eecom_club_id` FOREIGN KEY (`eecom_club_id`) REFERENCES `eecom_club` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_club_media.media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_league` (
                `id` BINARY(16) NOT NULL,
                `name` VARCHAR(255) NOT NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_league_region` (
                `id` BINARY(16) NOT NULL,
                `name` VARCHAR(255) NOT NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_team` (
                `id` BINARY(16) NOT NULL,
                `category_id` BINARY(16) NOT NULL,
                `category_version_id` BINARY(16) NULL,
                `active` TINYINT(1) NOT NULL DEFAULT 1,
                `profession` VARCHAR(255) NOT NULL,
                `sport_type` VARCHAR(255) NOT NULL,
                `team_type` VARCHAR(255) NOT NULL,
                `league_id` BINARY(16) NULL,
                `league_region_id` BINARY(16) NULL,
                `product_assignment_type` VARCHAR(255) NOT NULL DEFAULT \'product\',
                `product_stream_id` BINARY(16) NULL,
                `media_id` BINARY(16) NULL,
                `teaser_product_id` BINARY(16) NULL,
                `product_version_id` BINARY(16) NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`),
                CONSTRAINT `json.eecom_team.translated` CHECK (JSON_VALID(`translated`)),
                KEY `fk.eecom_team.category_id` (`category_id`,`category_version_id`),
                KEY `fk.eecom_team.product_stream_id` (`product_stream_id`),
                KEY `fk.eecom_team.media_id` (`media_id`),
                KEY `fk.eecom_team.league_id` (`league_id`),
                KEY `fk.eecom_team.league_region_id` (`league_region_id`),
                KEY `fk.eecom_team.teaser_product_id` (`teaser_product_id`,`product_version_id`),
                CONSTRAINT `fk.eecom_team.category_id` FOREIGN KEY (`category_id`,`category_version_id`) REFERENCES `category` (`id`,`version_id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_team.product_stream_id` FOREIGN KEY (`product_stream_id`) REFERENCES `product_stream` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_team.media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_team.league_id` FOREIGN KEY (`league_id`) REFERENCES `eecom_league` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_team.league_region_id` FOREIGN KEY (`league_region_id`) REFERENCES `eecom_league_region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_team.teaser_product_id` FOREIGN KEY (`teaser_product_id`,`product_version_id`) REFERENCES `product` (`id`,`version_id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_club_team` (
                `id` BINARY(16) NOT NULL,
                `eecom_club_id` BINARY(16) NOT NULL,
                `eecom_team_id` BINARY(16) NOT NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`),
                KEY `fk.eecom_club_team.eecom_club_id` (`eecom_club_id`),
                CONSTRAINT `fk.eecom_club_team.eecom_club_id` FOREIGN KEY (`eecom_club_id`) REFERENCES `eecom_club` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_team_translation` (
                `name` VARCHAR(255) NULL,
                `ground_name` VARCHAR(255) NULL,
                `team_description` LONGTEXT NULL,
                `custom_fields` JSON NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                `eecom_team_id` BINARY(16) NOT NULL,
                `language_id` BINARY(16) NOT NULL,
                PRIMARY KEY (`eecom_team_id`,`language_id`),
                CONSTRAINT `json.eecom_team_translation.custom_fields` CHECK (JSON_VALID(`custom_fields`)),
                KEY `fk.eecom_team_translation.eecom_team_id` (`eecom_team_id`),
                KEY `fk.eecom_team_translation.language_id` (`language_id`),
                CONSTRAINT `fk.eecom_team_translation.eecom_team_id` FOREIGN KEY (`eecom_team_id`) REFERENCES `eecom_team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_team_translation.language_id` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_team_media` (
                `eecom_team_id` BINARY(16) NOT NULL,
                `media_id` BINARY(16) NOT NULL,
                `created_at` DATETIME(3) NOT NULL,
                PRIMARY KEY (`eecom_team_id`,`media_id`),
                KEY `fk.eecom_team_media.eecom_team_id` (`eecom_team_id`),
                KEY `fk.eecom_team_media.media_id` (`media_id`),
                CONSTRAINT `fk.eecom_team_media.eecom_team_id` FOREIGN KEY (`eecom_team_id`) REFERENCES `eecom_team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_team_media.media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_team_product` (
                `eecom_team_id` BINARY(16) NOT NULL,
                `product_id` BINARY(16) NOT NULL,
                `product_version_id` BINARY(16) NOT NULL,
                `created_at` DATETIME(3) NOT NULL,
                PRIMARY KEY (`eecom_team_id`,`product_id`,`product_version_id`),
                KEY `fk.eecom_team_product.eecom_team_id` (`eecom_team_id`),
                KEY `fk.eecom_team_product.product_id` (`product_id`,`product_version_id`),
                CONSTRAINT `fk.eecom_team_product.eecom_team_id` FOREIGN KEY (`eecom_team_id`) REFERENCES `eecom_team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_team_product.product_id` FOREIGN KEY (`product_id`,`product_version_id`) REFERENCES `product` (`id`,`version_id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_player` (
                `id` BINARY(16) NOT NULL,
                `last_name` VARCHAR(255) NULL,
                `first_name` VARCHAR(255) NULL,
                `nick_name` VARCHAR(255) NULL,
                `active` TINYINT(1) NOT NULL DEFAULT 1,
                `hoc_member` TINYINT(1) NOT NULL DEFAULT 0,
                `player_flock_available` TINYINT(1) NOT NULL DEFAULT 0,
                `player_picture_media_id` BINARY(16) NULL,
                `street` VARCHAR(255) NULL,
                `number` INT(11) NULL,
                `zipcode` VARCHAR(255) NULL,
                `city` VARCHAR(255) NULL,
                `country_id` BINARY(16) NOT NULL,
                `phone` VARCHAR(255) NULL,
                `gender` VARCHAR(255) NULL,
                `nation_id` BINARY(16) NULL,
                `email1` VARCHAR(255) NULL,
                `email2` VARCHAR(255) NULL,
                `dob` DATE NULL,
                `favourite_player_number` INT(11) NULL,
                `player_pass_number` VARCHAR(255) NULL,
                `playing_foot` VARCHAR(255) NULL,
                `facebook_url` VARCHAR(255) NULL,
                `instagram_url` VARCHAR(255) NULL,
                `snapchat_url` VARCHAR(255) NULL,
                `profession` VARCHAR(255) NULL,
                `team_player_number` INT(11) NULL,
                `club_member_since` DATE NULL,
                `previous_club` VARCHAR(255) NULL,
                `jersey_size` VARCHAR(255) NULL,
                `short_size` VARCHAR(255) NULL,
                `shoe_size` DOUBLE NULL,
                `height` INT(11) NULL,
                `product_assignment_type` VARCHAR(255) NOT NULL DEFAULT \'product\',
                `product_stream_id` BINARY(16) NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`),
                KEY `fk.eecom_player.player_picture_media_id` (`player_picture_media_id`),
                KEY `fk.eecom_player.country_id` (`country_id`),
                KEY `fk.eecom_player.nation_id` (`nation_id`),
                KEY `fk.eecom_player.product_stream_id` (`product_stream_id`),
                CONSTRAINT `fk.eecom_player.player_picture_media_id` FOREIGN KEY (`player_picture_media_id`) REFERENCES `media` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_player.country_id` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_player.nation_id` FOREIGN KEY (`nation_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_player.product_stream_id` FOREIGN KEY (`product_stream_id`) REFERENCES `product_stream` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_team_player` (
                `id` BINARY(16) NOT NULL,
                `eecom_team_id` BINARY(16) NOT NULL,
                `eecom_player_id` BINARY(16) NOT NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`,`eecom_team_id`,`eecom_player_id`),
                KEY `fk.eecom_team_player.eecom_team_id` (`eecom_team_id`),
                CONSTRAINT `fk.eecom_team_player.eecom_team_id` FOREIGN KEY (`eecom_team_id`) REFERENCES `eecom_team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_player_product` (
                `eecom_player_id` BINARY(16) NOT NULL,
                `product_id` BINARY(16) NOT NULL,
                `product_version_id` BINARY(16) NOT NULL,
                `created_at` DATETIME(3) NOT NULL,
                PRIMARY KEY (`eecom_player_id`,`product_id`,`product_version_id`),
                KEY `fk.eecom_player_product.eecom_player_id` (`eecom_player_id`),
                KEY `fk.eecom_player_product.product_id` (`product_id`,`product_version_id`),
                CONSTRAINT `fk.eecom_player_product.eecom_player_id` FOREIGN KEY (`eecom_player_id`) REFERENCES `eecom_player` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_player_product.product_id` FOREIGN KEY (`product_id`,`product_version_id`) REFERENCES `product` (`id`,`version_id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_player_shoe` (
                `eecom_player_id` BINARY(16) NOT NULL,
                `product_id` BINARY(16) NOT NULL,
                `product_version_id` BINARY(16) NOT NULL,
                `created_at` DATETIME(3) NOT NULL,
                PRIMARY KEY (`eecom_player_id`,`product_id`,`product_version_id`),
                KEY `fk.eecom_player_shoe.eecom_player_id` (`eecom_player_id`),
                KEY `fk.eecom_player_shoe.product_id` (`product_id`,`product_version_id`),
                CONSTRAINT `fk.eecom_player_shoe.eecom_player_id` FOREIGN KEY (`eecom_player_id`) REFERENCES `eecom_player` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_player_shoe.product_id` FOREIGN KEY (`product_id`,`product_version_id`) REFERENCES `product` (`id`,`version_id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_playing_position` (
                `id` BINARY(16) NOT NULL,
                `name` VARCHAR(255) NOT NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_player_playing_position_1` (
                `eecom_player_id` BINARY(16) NOT NULL,
                `eecom_playing_position_id` BINARY(16) NOT NULL,
                PRIMARY KEY (`eecom_player_id`,`eecom_playing_position_id`),
                KEY `fk.eecom_player_playing_position_1.eecom_player_id` (`eecom_player_id`),
                KEY `fk.eecom_player_playing_position_1.eecom_playing_position_id` (`eecom_playing_position_id`),
                CONSTRAINT `fk.eecom_player_playing_position_1.eecom_player_id` FOREIGN KEY (`eecom_player_id`) REFERENCES `eecom_player` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_player_playing_position_1.eecom_playing_position_id` FOREIGN KEY (`eecom_playing_position_id`) REFERENCES `eecom_playing_position` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_player_playing_position_2` (
                `eecom_player_id` BINARY(16) NOT NULL,
                `eecom_playing_position_id` BINARY(16) NOT NULL,
                PRIMARY KEY (`eecom_player_id`,`eecom_playing_position_id`),
                KEY `fk.eecom_player_playing_position_2.eecom_player_id` (`eecom_player_id`),
                KEY `fk.eecom_player_playing_position_2.eecom_playing_position_id` (`eecom_playing_position_id`),
                CONSTRAINT `fk.eecom_player_playing_position_2.eecom_player_id` FOREIGN KEY (`eecom_player_id`) REFERENCES `eecom_player` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_player_playing_position_2.eecom_playing_position_id` FOREIGN KEY (`eecom_playing_position_id`) REFERENCES `eecom_playing_position` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `eecom_player_team_position` (
                `eecom_player_id` BINARY(16) NOT NULL,
                `eecom_playing_position_id` BINARY(16) NOT NULL,
                PRIMARY KEY (`eecom_player_id`,`eecom_playing_position_id`),
                KEY `fk.eecom_player_team_position.eecom_player_id` (`eecom_player_id`),
                KEY `fk.eecom_player_team_position.eecom_playing_position_id` (`eecom_playing_position_id`),
                CONSTRAINT `fk.eecom_player_team_position.eecom_player_id` FOREIGN KEY (`eecom_player_id`) REFERENCES `eecom_player` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.eecom_player_team_position.eecom_playing_position_id` FOREIGN KEY (`eecom_playing_position_id`) REFERENCES `eecom_playing_position` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $this->updateInheritance($connection, 'product', 'teamProducts');
        $this->updateInheritance($connection, 'product', 'playerProducts');
        $this->updateInheritance($connection, 'product', 'playerShoeProducts');
        $this->updateInheritance($connection, 'product', 'teaserProduct');
        $this->updateInheritance($connection, 'category', 'teamCategory');
    }

    public function updateDestructive(Connection $connection): void
    {
    }
}
