<?php

/**
 * This file contains the item class for the Castanet package
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
 * @package   Castanet
 * @author    Michael Gauthier <mike@silverorange.com>
 * @author    Charles Waddell <charles@silverorange.com>
 * @copyright 2011-2017 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @link      https://github.com/silverorange/castanet
 */

require_once 'Castanet.php';

/**
 * Class used to generate individual items in a podcast.
 *
 * @category  XML
 * @package   Castanet
 * @author    Michael Gauthier <mike@silverorange.com>
 * @author    Charles Waddell <charles@silverorange.com>
 * @copyright 2011-2017 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @link      https://github.com/silverorange/castanet
 */
class Castanet_Item
{
    // {{{ protected properties

    /**
     * Title of this item
     *
     * @var string
     */
    protected $title;

    /**
     * Web link of this item
     *
     * @var string
     */
    protected $link;

    /**
     * Short description of this item
     *
     * @var string
     */
    protected $description;

    /**
     * Publish date of this item
     *
     * Formatted as RFC 3339 string.
     *
     * @var string
     */
    protected $publish_date;

    /**
     * The iTunes cover image of this item
     *
     * @var string
     */
    protected $itunes_image_url;

    /**
     * The URL of the media for this item
     *
     * @var string
     */
    protected $media_url;

    /**
     * Size of the media of this item in bytes
     *
     * @var integer
     */
    protected $media_size;

    /**
     * Mime-type of the media of this item
     *
     * @var string
     */
    protected $media_mime_type;

    /**
     * Duration of the media of this item in seconds
     *
     * @var integer
     */
    protected $media_duration;

    /**
     * The iTunes subtitle of this item
     *
     * @var string
     */
    protected $itunes_subtitle;

    /**
     * The iTunes summary of this item
     *
     * @var string
     */
    protected $itunes_summary;

    /**
     * The globally unique identifier for this item
     *
     * Usually this is the web URL.
     *
     * @var string
     */
    protected $guid;

    /**
     * Whether or not the GUID of this item is also a web permalink
     *
     * @var boolean
     */
    protected $guid_is_permalink = true;

    // }}}
    // {{{ public function setTitle()

    /**
     * Sets the title of this item
     *
     * @param string $title the title of this item.
     *
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = strval($title);
    }

    // }}}
    // {{{ public function setLink()

    /**
     * Sets the web link of this item
     *
     * @param string $link the web link of this item.
     *
     * @return void
     */
    public function setLink($link)
    {
        $this->link = strval($link);
    }

    // }}}
    // {{{ public function setGuid()

    /**
     * Sets the globally unique identifier fof this item
     *
     * @param string  $guid         the globally unique identifier of this item.
     * @param boolean $is_permalink optional. Whether or not the GUID is a
     *                              web permalink.
     *
     * @return void
     */
    public function setGuid($guid, $is_permalink = true)
    {
        $this->guid = strval($guid);
        $this->guid_is_permalink = ($is_permalink) ? true : false;
    }

    // }}}
    // {{{ public function setDescription()

    /**
     * Sets the short description of this item
     *
     * @param string $description the short description of this item.
     *
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = strval($description);
    }

    // }}}
    // {{{ public function setPublishDate()

    /**
     * Sets the publish date of this item
     *
     * @param string|DateTime $date the publish date of this item. Either a
     *                              RFC 3339 formatted string or a DateTime
     *                              object.
     *
     * @return void
     */
    public function setPublishDate($date)
    {
        if ($date instanceof DateTime) {
            $date = $date->format('r');
        }
        $this->publish_date = $date;
    }

    // }}}
    // {{{ public function setMediaUrl()

    /**
     * Sets the media URL of this item
     *
     * @param string $url the media URL of this item.
     *
     * @return void
     */
    public function setMediaUrl($url)
    {
        $this->media_url = strval($url);
    }

    // }}}
    // {{{ public function setMediaSize()

    /**
     * Sets the size of the media of this item
     *
     * @param integer $size the size of the media of this item in bytes.
     *
     * @return void
     */
    public function setMediaSize($size)
    {
        $this->media_size = intval($size);
    }

    // }}}
    // {{{ public function setMediaMimeType()

    /**
     * Sets the mime-type of the media of this item
     *
     * @param string $mime_type the mime-type of the media of this item.
     *
     * @return void
     */
    public function setMediaMimeType($mime_type)
    {
        $this->media_mime_type = strval($mime_type);
    }

    // }}}
    // {{{ public function setMediaDuration()

    /**
     * Sets the duration of the media of this item
     *
     * @param integer $duration the duration of the media of this item in
     *                          seconds.
     *
     * @return void
     */
    public function setMediaDuration($duration)
    {
        $this->media_duration = intval($duration);
    }

    // }}}
    // {{{ public function setItunesSubtitle()

    /**
     * Sets the iTunes subtitle of this item
     *
     * @param string $subtitle the iTunes subtitle of this item.
     *
     * @return void
     */
    public function setItunesSubtitle($subtitle)
    {
        $this->itunes_subtitle = strval($subtitle);
    }

    // }}}
    // {{{ public function setItunesSummary()

    /**
     * Sets the iTunes summary of this item
     *
     * @param string $summary the iTunes summary of this item.
     *
     * @return void
     */
    public function setItunesSummary($summary)
    {
        $this->itunes_summary = strval($summary);
    }

    // }}}
    // {{{ public function setItunesImage()

    /**
     * Sets the iTunes cover image of this item
     *
     * @param string $url the iTunes cover image of this item.
     *
     * @return void
     */
    public function setItunesImage($url)
    {
        $this->itunes_image_url = strval($url);
    }

    // }}}
    // {{{ public function build()

    /**
     * Builds this DOMNode for this item
     *
     * Creates the item node and appends it to the parent.
     *
     * @param DOMNode $parent the parent node of this item. Usually a Feed node.
     *
     * @return void
     */
    public function build(DOMNode $parent)
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

    // }}}
    // {{{ protected function buildTitle()

    /**
     * Builds the title node for this item
     *
     * @param DOMNode $parent the item node.
     *
     * @return void
     */
    protected function buildTitle(DOMNode $parent)
    {
        if ($this->title != '') {
            $document = $parent->ownerDocument;

            $text = $document->createTextNode($this->title);
            $node = $document->createElement('title');

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    // }}}
    // {{{ protected function buildLink()

    /**
     * Builds the link node for this item
     *
     * @param DOMNode $parent the item node.
     *
     * @return void
     */
    protected function buildLink(DOMNode $parent)
    {
        if ($this->link != '') {
            $document = $parent->ownerDocument;

            $text = $document->createTextNode($this->link);
            $node = $document->createElement('link');

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    // }}}
    // {{{ protected function buildGuid()

    /**
     * Builds the GUID node for this item
     *
     * @param DOMNode $parent the item node.
     *
     * @return void
     */
    protected function buildGuid(DOMNode $parent)
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

    // }}}
    // {{{ protected function buildItunesSubtitle()

    /**
     * Builds the iTunes subtitle node for this item
     *
     * @param DOMNode $parent the item node.
     *
     * @return void
     */
    protected function buildItunesSubtitle(DOMNode $parent)
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

    // }}}
    // {{{ protected function buildItunesSummary()

    /**
     * Builds the iTunes summary node for this item
     *
     * @param DOMNode $parent the item node.
     *
     * @return void
     */
    protected function buildItunesSummary(DOMNode $parent)
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

    // }}}
    // {{{ protected function buildItunesImage()

    /**
     * Builds the iTunes image node for this item
     *
     * @param DOMNode $parent the item node.
     *
     * @return void
     */
    protected function buildItunesImage(DOMNode $parent)
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

    // }}}
    // {{{ protected function buildDescription()

    /**
     * Builds the description node for this item
     *
     * @param DOMNode $parent the item node.
     *
     * @return void
     */
    protected function buildDescription(DOMNode $parent)
    {
        if ($this->description != '') {
            $document = $parent->ownerDocument;

            $node = $document->createElement('description');
            $text = $document->createCDATASection($this->description);

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    // }}}
    // {{{ protected function buildPublishDate()

    /**
     * Builds the publish date node for this item
     *
     * @param DOMNode $parent the item node.
     *
     * @return void
     */
    protected function buildPublishDate(DOMNode $parent)
    {
        if ($this->publish_date != '') {
            $document = $parent->ownerDocument;

            $text = $document->createTextNode($this->publish_date);
            $node = $document->createElement('pubDate');

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    // }}}
    // {{{ protected function buildMediaEnclosure()

    /**
     * Builds the media enclosure node for this item
     *
     * @param DOMNode $parent the item node.
     *
     * @return void
     */
    protected function buildMediaEnclosure(DOMNode $parent)
    {
        $document = $parent->ownerDocument;

        $node = $document->createElement('enclosure');
        $node->setAttribute('url', $this->media_url);
        $node->setAttribute('length', $this->media_size);
        $node->setAttribute('type', $this->media_mime_type);
        $parent->appendChild($node);
    }

    // }}}
    // {{{ protected function buildMediaDuration()

    /**
     * Builds the media duration node for this item
     *
     * @param DOMNode $parent the item node.
     *
     * @return void
     */
    protected function buildMediaDuration(DOMNode $parent)
    {
        $document = $parent->ownerDocument;

        if ($this->media_duration != '') {
            $duration = $this->media_duration;

            $hours    = intval($duration / 3600);
            $duration -= ($hours > 0) ? ($hours * 3600) : 0;
            $minutes  = intval($duration / 60);
            $duration -= ($minutes > 0) ? ($minutes * 60) : 0;
            $seconds  = $duration;

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

    // }}}
}

?>
