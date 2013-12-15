<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Options;

use Widop\Twitter\Rest\Options\OptionInterface;

/**
 * Option factory.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OptionFactory
{
    /** @var array */
    private $mapping;

    /**
     * Creates an option factory.
     */
    public function __construct()
    {
        $this->mapping = array(
            'accuracy'                     => 'Widop\Twitter\Rest\Options\AccuracyOption',
            'align'                        => 'Widop\Twitter\Rest\Options\AlignOption',
            'attribute:street_address'     => 'Widop\Twitter\Rest\Options\AttributeStreetAddressOption',
            'banner'                       => 'Widop\Twitter\Rest\Options\BannerOption',
            'contributor_details'          => 'Widop\Twitter\Rest\Options\ContributorDetailsOption',
            'callback'                     => 'Widop\Twitter\Rest\Options\CallbackOption',
            'contained_within'             => 'Widop\Twitter\Rest\Options\ContainedWithinOption',
            'count'                        => 'Widop\Twitter\Rest\Options\CountOption',
            'cursor'                       => 'Widop\Twitter\Rest\Options\CursorOption',
            'description'                  => 'Widop\Twitter\Rest\Options\DescriptionOption',
            'device'                       => 'Widop\Twitter\Rest\Options\DeviceOption',
            'device_notification'          => 'Widop\Twitter\Rest\Options\DeviceNotificationOption',
            'display_coordinates'          => 'Widop\Twitter\Rest\Options\DisplayCoordinatesOption',
            'end_sleep_time'               => 'Widop\Twitter\Rest\Options\EndSleepTimeOption',
            'exclude'                      => 'Widop\Twitter\Rest\Options\ExcludeOption',
            'exclude_replies'              => 'Widop\Twitter\Rest\Options\ExcludeRepliesOption',
            'follow'                       => 'Widop\Twitter\Rest\Options\FollowOption',
            'geocode'                      => 'Widop\Twitter\Rest\Options\GeocodeOption',
            'granularity'                  => 'Widop\Twitter\Rest\Options\GranularityOption',
            'height'                       => 'Widop\Twitter\Rest\Options\HeightOption',
            'hide_media'                   => 'Widop\Twitter\Rest\Options\HideMediaOption',
            'hide_thread'                  => 'Widop\Twitter\Rest\Options\HideThreadOption',
            'id'                           => 'Widop\Twitter\Rest\Options\IdOption',
            'image'                        => 'Widop\Twitter\Rest\Options\ImageOption',
            'in_reply_to_status_id'        => 'Widop\Twitter\Rest\Options\InReplyToStatusIdOption',
            'include_entities'             => 'Widop\Twitter\Rest\Options\IncludeEntitiesOption',
            'include_my_retweet'           => 'Widop\Twitter\Rest\Options\IncludeMyRetweetOption',
            'include_rts'                  => 'Widop\Twitter\Rest\Options\IncludeRtsOption',
            'include_user_entities'        => 'Widop\Twitter\Rest\Options\IncludeUserEntitiesOption',
            'ip'                           => 'Widop\Twitter\Rest\Options\IpOption',
            'lang'                         => 'Widop\Twitter\Rest\Options\LangOption',
            'lat'                          => 'Widop\Twitter\Rest\Options\LatOption',
            'locale'                       => 'Widop\Twitter\Rest\Options\LocaleOption',
            'location'                     => 'Widop\Twitter\Rest\Options\LocationOption',
            'long'                         => 'Widop\Twitter\Rest\Options\LongOption',
            'max_id'                       => 'Widop\Twitter\Rest\Options\MaxIdOption',
            'max_results'                  => 'Widop\Twitter\Rest\Options\MaxResultsOption',
            'maxwidth'                     => 'Widop\Twitter\Rest\Options\MaxwidthOption',
            'media'                        => 'Widop\Twitter\Rest\Options\MediaOption',
            'name'                         => 'Widop\Twitter\Rest\Options\NameOption',
            'offset_left'                  => 'Widop\Twitter\Rest\Options\OffsetLeftOption',
            'offset_top'                   => 'Widop\Twitter\Rest\Options\OffsetTopOption',
            'omit_script'                  => 'Widop\Twitter\Rest\Options\OmitScriptOption',
            'page'                         => 'Widop\Twitter\Rest\Options\PageOption',
            'place_id'                     => 'Widop\Twitter\Rest\Options\PlaceIdOption',
            'profile_background_color'     => 'Widop\Twitter\Rest\Options\ProfileBackgroundColorOption',
            'profile_link_color'           => 'Widop\Twitter\Rest\Options\ProfileLinkColorOption',
            'profile_sidebar_border_color' => 'Widop\Twitter\Rest\Options\ProfileSidebarBorderColorOption',
            'profile_sidebar_fill_color'   => 'Widop\Twitter\Rest\Options\ProfileSidebarFillColorOption',
            'profile_text_color'           => 'Widop\Twitter\Rest\Options\ProfileTextColorOption',
            'q'                            => 'Widop\Twitter\Rest\Options\QOption',
            'query'                        => 'Widop\Twitter\Rest\Options\QueryOption',
            'related'                      => 'Widop\Twitter\Rest\Options\RelatedOption',
            'result_type'                  => 'Widop\Twitter\Rest\Options\ResultTypeOption',
            'retweets'                     => 'Widop\Twitter\Rest\Options\RetweetsOption',
            'screen_name'                  => 'Widop\Twitter\Rest\Options\ScreenNameOption',
            'since_id'                     => 'Widop\Twitter\Rest\Options\SinceIdOption',
            'skip_status'                  => 'Widop\Twitter\Rest\Options\SkipStatusOption',
            'sleep_time_enabled'           => 'Widop\Twitter\Rest\Options\SleepTimeEnabledOption',
            'slug'                         => 'Widop\Twitter\Rest\Options\SlugOption',
            'source_id'                    => 'Widop\Twitter\Rest\Options\SourceIdOption',
            'source_screen_name'           => 'Widop\Twitter\Rest\Options\SourceScreenNameOption',
            'start_sleep_time'             => 'Widop\Twitter\Rest\Options\StartSleepTimeOption',
            'status'                       => 'Widop\Twitter\Rest\Options\StatusOption',
            'stringify_ids'                => 'Widop\Twitter\Rest\Options\StringifyIdsOption',
            'target_id'                    => 'Widop\Twitter\Rest\Options\TargetIdOption',
            'target_screen_name'           => 'Widop\Twitter\Rest\Options\TargetScreenNameOption',
            'text'                         => 'Widop\Twitter\Rest\Options\TextOption',
            'tile'                         => 'Widop\Twitter\Rest\Options\TileOption',
            'time_zone'                    => 'Widop\Twitter\Rest\Options\TimeZoneOption',
            'trend_location_woeid'         => 'Widop\Twitter\Rest\Options\TrendLocationWoeidOption',
            'trim_user'                    => 'Widop\Twitter\Rest\Options\TrimUserOption',
            'until'                        => 'Widop\Twitter\Rest\Options\UntilOption',
            'url'                          => 'Widop\Twitter\Rest\Options\UrlOption',
            'use'                          => 'Widop\Twitter\Rest\Options\UseOption',
            'user_id'                      => 'Widop\Twitter\Rest\Options\UserIdOption',
            'width'                        => 'Widop\Twitter\Rest\Options\WidthOption',
        );
    }

    /**
     * Creates an option.
     *
     * @param string $option The option name.
     * @param string $type   The option type.
     *
     * @throws \InvalidArgumentException If the option does not exist.
     *
     * @return \Widop\Twitter\Rest\Options\OptionInterface The option.
     */
    public function create($option, $type = OptionInterface::TYPE_GET)
    {
        if (!isset($this->mapping[$option])) {
            throw new \InvalidArgumentException(sprintf('The option "%s" does not exist.', $option));
        }

        return new $this->mapping[$option]($type);
    }
}
