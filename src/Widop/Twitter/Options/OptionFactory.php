<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Options;

use Widop\Twitter\Options\OptionInterface;

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
            'align'                        => 'Widop\Twitter\Options\AlignOption',
            'banner'                       => 'Widop\Twitter\Options\BannerOption',
            'contributor_details'          => 'Widop\Twitter\Options\ContributorDetailsOption',
            'callback'                     => 'Widop\Twitter\Options\CallbackOption',
            'count'                        => 'Widop\Twitter\Options\CountOption',
            'cursor'                       => 'Widop\Twitter\Options\CursorOption',
            'description'                  => 'Widop\Twitter\Options\DescriptionOption',
            'device'                       => 'Widop\Twitter\Options\DeviceOption',
            'display_coordinates'          => 'Widop\Twitter\Options\DisplayCoordinatesOption',
            'end_sleep_time'               => 'Widop\Twitter\Options\EndSleepTimeOption',
            'exclude'                      => 'Widop\Twitter\Options\ExcludeOption',
            'exclude_replies'              => 'Widop\Twitter\Options\ExcludeRepliesOption',
            'follow'                       => 'Widop\Twitter\Options\FollowOption',
            'geocode'                      => 'Widop\Twitter\Options\GeocodeOption',
            'height'                       => 'Widop\Twitter\Options\HeightOption',
            'hide_media'                   => 'Widop\Twitter\Options\HideMediaOption',
            'hide_thread'                  => 'Widop\Twitter\Options\HideThreadOption',
            'id'                           => 'Widop\Twitter\Options\IdOption',
            'image'                        => 'Widop\Twitter\Options\ImageOption',
            'in_reply_to_status_id'        => 'Widop\Twitter\Options\InReplyToStatusIdOption',
            'include_entities'             => 'Widop\Twitter\Options\IncludeEntitiesOption',
            'include_my_retweet'           => 'Widop\Twitter\Options\IncludeMyRetweetOption',
            'include_rts'                  => 'Widop\Twitter\Options\IncludeRtsOption',
            'include_user_entities'        => 'Widop\Twitter\Options\IncludeUserEntitiesOption',
            'lang'                         => 'Widop\Twitter\Options\LangOption',
            'lat'                          => 'Widop\Twitter\Options\LatOption',
            'locale'                       => 'Widop\Twitter\Options\LocaleOption',
            'location'                     => 'Widop\Twitter\Options\LocationOption',
            'long'                         => 'Widop\Twitter\Options\LongOption',
            'max_id'                       => 'Widop\Twitter\Options\MaxIdOption',
            'maxwidth'                     => 'Widop\Twitter\Options\MaxwidthOption',
            'media'                        => 'Widop\Twitter\Options\MediaOption',
            'name'                         => 'Widop\Twitter\Options\NameOption',
            'offset_left'                  => 'Widop\Twitter\Options\OffsetLeftOption',
            'offset_top'                   => 'Widop\Twitter\Options\OffsetTopOption',
            'omit_script'                  => 'Widop\Twitter\Options\OmitScriptOption',
            'page'                         => 'Widop\Twitter\Options\PageOption',
            'place_id'                     => 'Widop\Twitter\Options\PlaceIdOption',
            'profile_background_color'     => 'Widop\Twitter\Options\ProfileBackgroundColorOption',
            'profile_link_color'           => 'Widop\Twitter\Options\ProfileLinkColorOption',
            'profile_sidebar_border_color' => 'Widop\Twitter\Options\ProfileSidebarBorderColorOption',
            'profile_sidebar_fill_color'   => 'Widop\Twitter\Options\ProfileSidebarFillColorOption',
            'profile_text_color'           => 'Widop\Twitter\Options\ProfileTextColorOption',
            'q'                            => 'Widop\Twitter\Options\QOption',
            'query'                        => 'Widop\Twitter\Options\QueryOption',
            'related'                      => 'Widop\Twitter\Options\RelatedOption',
            'result_type'                  => 'Widop\Twitter\Options\ResultTypeOption',
            'retweets'                     => 'Widop\Twitter\Options\RetweetsOption',
            'screen_name'                  => 'Widop\Twitter\Options\ScreenNameOption',
            'since_id'                     => 'Widop\Twitter\Options\SinceIdOption',
            'skip_status'                  => 'Widop\Twitter\Options\SkipStatusOption',
            'sleep_time_enabled'           => 'Widop\Twitter\Options\SleepTimeEnabledOption',
            'source_id'                    => 'Widop\Twitter\Options\SourceIdOption',
            'source_screen_name'           => 'Widop\Twitter\Options\SourceScreenNameOption',
            'start_sleep_time'             => 'Widop\Twitter\Options\StartSleepTimeOption',
            'status'                       => 'Widop\Twitter\Options\StatusOption',
            'stringify_ids'                => 'Widop\Twitter\Options\StringifyIdsOption',
            'target_id'                    => 'Widop\Twitter\Options\TargetIdOption',
            'target_screen_name'           => 'Widop\Twitter\Options\TargetScreenNameOption',
            'text'                         => 'Widop\Twitter\Options\TextOption',
            'tile'                         => 'Widop\Twitter\Options\TileOption',
            'time_zone'                    => 'Widop\Twitter\Options\TimeZoneOption',
            'trend_location_woeid'         => 'Widop\Twitter\Options\TrendLocationWoeidOption',
            'trim_user'                    => 'Widop\Twitter\Options\TrimUserOption',
            'until'                        => 'Widop\Twitter\Options\UntilOption',
            'url'                          => 'Widop\Twitter\Options\UrlOption',
            'use'                          => 'Widop\Twitter\Options\UseOption',
            'user_id'                      => 'Widop\Twitter\Options\UserIdOption',
            'width'                        => 'Widop\Twitter\Options\WidthOption',
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
     * @return \Widop\Twitter\Options\OptionInterface The option.
     */
    public function create($option, $type = OptionInterface::TYPE_GET)
    {
        if (!isset($this->mapping[$option])) {
            throw new \InvalidArgumentException(sprintf('The option "%s" does not exist.', $option));
        }

        return new $this->mapping[$option]($type);
    }
}
