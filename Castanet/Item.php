<?php

/**
 * This file contains the item class for the Castanet package.
 *
 * PHP version 5, 7
 *
 * LICENSE:
 *
 * The MIT License (MIT)
 *
 * Copyright (c) 2011-2017 silverorange
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 *
 * @category  XML
 *
 * @author    Michael Gauthier <mike@silverorange.com>
 * @author    Charles Waddell <charles@silverorange.com>
 * @copyright 2011-2017 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 *
 * @see      https://github.com/silverorange/castanet
 */

/**
 * Class used to generate individual items in a podcast.
 *
 * @category  XML
 *
 * @author    Michael Gauthier <mike@silverorange.com>
 * @author    Charles Waddell <charles@silverorange.com>
 * @copyright 2011-2017 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 *
 * @see      https://github.com/silverorange/castanet
 */
class Castanet_Item
{
    /**
     * Title of this item.
     *
     * @var string
     */
    protected $title;

    /**
     * Web link of this item.
     *
     * @var string
     */
    protected $link;

    /**
     * Short description of this item.
     *
     * @var string
     */
    protected $description;

    /**
     * Publish date of this item.
     *
     * Formatted as RFC 3339 string.
     *
     * @var string
     */
    protected $publish_date;

    /**
     * The iTunes cover image of this item.
     *
     * @var string
     */
    protected $itunes_image_url;

    /**
     * The URL of the media for this item.
     *
     * @var string
     */
    protected $media_url;

    /**
     * Size of the media of this item in bytes.
     *
     * @var int
     */
    protected $media_size;

    /**
     * Mime-type of the media of this item.
     *
     * @var string
     */
    protected $media_mime_type;

    /**
     * Duration of the media of this item in seconds.
     *
     * @var int
     */
    protected $media_duration;

    /**
     * The iTunes subtitle of this item.
     *
     * @var string
     */
    protected $itunes_subtitle;

    /**
     * The iTunes summary of this item.
     *
     * @var string
     */
    protected $itunes_summary;

    /**
     * The globally unique identifier for this item.
     *
     * Usually this is the web URL.
     *
     * @var string
     */
    protected $guid;

    /**
     * Whether or not the GUID of this item is also a web permalink.
     */
    protected bool $guid_is_permalink = true;

    /**
     * Sets the title of this item.
     *
     * @param string $title the title of this item
     */
    public function setTitle($title): void
    {
        $this->title = strval($title);
    }

    /**
     * Sets the web link of this item.
     *
     * @param string $link the web link of this item
     */
    public function setLink($link): void
    {
        $this->link = strval($link);
    }

    /**
     * Sets the globally unique identifier fof this item.
     *
     * @param string $guid         the globally unique identifier of this item
     * @param bool   $is_permalink optional. Whether or not the GUID is a
     *                             web permalink.
     */
    public function setGuid($guid, $is_permalink = true): void
    {
        $this->guid = strval($guid);
        $this->guid_is_permalink = ($is_permalink) ? true : false;
    }

    /**
     * Sets the short description of this item.
     *
     * @param string $description the short description of this item
     */
    public function setDescription($description): void
    {
        $this->description = strval($description);
    }

    /**
     * Sets the publish date of this item.
     *
     * @param DateTime|string $date the publish date of this item. Either a
     *                              RFC 3339 formatted string or a DateTime
     *                              object.
     */
    public function setPublishDate($date): void
    {
        if ($date instanceof DateTime) {
            $date = $date->format('r');
        }
        $this->publish_date = $date;
    }

    /**
     * Sets the media URL of this item.
     *
     * @param string $url the media URL of this item
     */
    public function setMediaUrl($url): void
    {
        $this->media_url = strval($url);
    }

    /**
     * Sets the size of the media of this item.
     *
     * @param int $size the size of the media of this item in bytes
     */
    public function setMediaSize($size): void
    {
        $this->media_size = intval($size);
    }

    /**
     * Sets the mime-type of the media of this item.
     *
     * @param string $mime_type the mime-type of the media of this item
     */
    public function setMediaMimeType($mime_type): void
    {
        $this->media_mime_type = strval($mime_type);
    }

    /**
     * Sets the duration of the media of this item.
     *
     * @param int $duration the duration of the media of this item in
     *                      seconds
     */
    public function setMediaDuration($duration): void
    {
        $this->media_duration = intval($duration);
    }

    /**
     * Sets the iTunes subtitle of this item.
     *
     * @param string $subtitle the iTunes subtitle of this item
     */
    public function setItunesSubtitle($subtitle): void
    {
        $this->itunes_subtitle = strval($subtitle);
    }

    /**
     * Sets the iTunes summary of this item.
     *
     * @param string $summary the iTunes summary of this item
     */
    public function setItunesSummary($summary): void
    {
        $this->itunes_summary = strval($summary);
    }

    /**
     * Sets the iTunes cover image of this item.
     *
     * @param string $url the iTunes cover image of this item
     */
    public function setItunesImage($url): void
    {
        $this->itunes_image_url = strval($url);
    }

    /**
     * Builds this DOMNode for this item.
     *
     * Creates the item node and appends it to the parent.
     *
     * @param DOMNode $parent the parent node of this item. Usually a Feed node.
     */
    public function build(DOMNode $parent): void
    {
        $document = $parent->ownerDocument;

        $item = $document->createElement('item');
        $parent->appendChild($item);

        $this->buildTitle($item);
        $this->buildLink($item);
        $this->buildGuid($item);
        $this->buildItunesSubtitle($item);
        $this->buildItunesSummary($item);
        $this->buildItunesImage($item);
        $this->buildDescription($item);
        $this->buildPublishDate($item);
        $this->buildMediaEnclosure($item);
        $this->buildMediaDuration($item);
    }

    /**
     * Builds the title node for this item.
     *
     * @param DOMNode $parent the item node
     */
    protected function buildTitle(DOMNode $parent): void
    {
        if ($this->title != '') {
            $document = $parent->ownerDocument;

            $text = $document->createTextNode($this->title);
            $node = $document->createElement('title');

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    /**
     * Builds the link node for this item.
     *
     * @param DOMNode $parent the item node
     */
    protected function buildLink(DOMNode $parent): void
    {
        if ($this->link != '') {
            $document = $parent->ownerDocument;

            $text = $document->createTextNode($this->link);
            $node = $document->createElement('link');

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    /**
     * Builds the GUID node for this item.
     *
     * @param DOMNode $parent the item node
     */
    protected function buildGuid(DOMNode $parent): void
    {
        if ($this->guid != '') {
            $document = $parent->ownerDocument;

            $text = $document->createTextNode($this->guid);
            $node = $document->createElement('guid');

            if (!$this->guid_is_permalink) {
                $node->setAttribute('isPermaLink', 'false');
            }

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    /**
     * Builds the iTunes subtitle node for this item.
     *
     * @param DOMNode $parent the item node
     */
    protected function buildItunesSubtitle(DOMNode $parent): void
    {
        if ($this->itunes_subtitle != '') {
            $document = $parent->ownerDocument;

            $node = $document->createElementNS(
                Castanet::ITUNES_NAMESPACE,
                'subtitle'
            );

            $text = $document->createCDATASection($this->itunes_subtitle);

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    /**
     * Builds the iTunes summary node for this item.
     *
     * @param DOMNode $parent the item node
     */
    protected function buildItunesSummary(DOMNode $parent): void
    {
        if ($this->itunes_summary != '') {
            $document = $parent->ownerDocument;

            $node = $document->createElementNS(
                Castanet::ITUNES_NAMESPACE,
                'summary'
            );

            $text = $document->createCDATASection($this->itunes_summary);

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    /**
     * Builds the iTunes image node for this item.
     *
     * @param DOMNode $parent the item node
     */
    protected function buildItunesImage(DOMNode $parent): void
    {
        if ($this->itunes_image_url != '') {
            $document = $parent->ownerDocument;

            $image_node = $document->createElementNS(
                Castanet::ITUNES_NAMESPACE,
                'image'
            );

            $image_node->setAttribute('href', $this->itunes_image_url);

            $parent->appendChild($image_node);
        }
    }

    /**
     * Builds the description node for this item.
     *
     * @param DOMNode $parent the item node
     */
    protected function buildDescription(DOMNode $parent): void
    {
        if ($this->description != '') {
            $document = $parent->ownerDocument;

            $node = $document->createElement('description');
            $text = $document->createCDATASection($this->description);

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    /**
     * Builds the publish date node for this item.
     *
     * @param DOMNode $parent the item node
     */
    protected function buildPublishDate(DOMNode $parent): void
    {
        if ($this->publish_date != '') {
            $document = $parent->ownerDocument;

            $text = $document->createTextNode($this->publish_date);
            $node = $document->createElement('pubDate');

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    /**
     * Builds the media enclosure node for this item.
     *
     * @param DOMNode $parent the item node
     */
    protected function buildMediaEnclosure(DOMNode $parent): void
    {
        $document = $parent->ownerDocument;

        $node = $document->createElement('enclosure');
        $node->setAttribute('url', $this->media_url);
        $node->setAttribute('length', strval($this->media_size));
        $node->setAttribute('type', $this->media_mime_type);
        $parent->appendChild($node);
    }

    /**
     * Builds the media duration node for this item.
     *
     * @param DOMNode $parent the item node
     */
    protected function buildMediaDuration(DOMNode $parent): void
    {
        $document = $parent->ownerDocument;

        if ($this->media_duration != '') {
            $duration = $this->media_duration;

            $hours = intval($duration / 3600);
            $duration -= ($hours > 0) ? ($hours * 3600) : 0;
            $minutes = intval($duration / 60);
            $duration -= ($minutes > 0) ? ($minutes * 60) : 0;
            $seconds = $duration;

            $formatted_duration = sprintf(
                '%d:%02d:%02d',
                $hours,
                $minutes,
                $seconds
            );

            $node = $document->createElementNS(
                Castanet::ITUNES_NAMESPACE,
                'duration',
                $formatted_duration
            );

            $parent->appendChild($node);
        }
    }
}
