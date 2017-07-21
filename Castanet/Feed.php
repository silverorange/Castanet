<?php

/**
 * This file contains the feed object for the Castanet package
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
require_once 'Castanet/Item.php';

/**
 * Class used to generate a podcast.
 *
 * @category  XML
 * @package   Castanet
 * @author    Michael Gauthier <mike@silverorange.com>
 * @author    Charles Waddell <charles@silverorange.com>
 * @copyright 2011-2017 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @link      https://github.com/silverorange/castanet
 */
class Castanet_Feed
{
    // {{{ protected properties

    /**
     * The title of this feed
     *
     * @var string
     */
    protected $title;

    /**
     * The web link of this feed
     *
     * @var string
     */
    protected $link;

    /**
     * The description of this feed
     *
     * @var string
     */
    protected $description;

    /**
     * The ISO 629-1 language of this feed
     *
     * @var string
     */
    protected $language;

    /**
     * The copyright attribution of this feed
     *
     * @var string
     */
    protected $copyright;

    /**
     * The managing editor of this feed
     *
     * @var string
     */
    protected $managing_editor;

    /**
     * The iTunes cover image of this feed
     *
     * @var string
     */
    protected $itunes_image_url;

    /**
     * The RSS image of this feed
     *
     * @var string
     */
    protected $image_url;

    /**
     * The width of the RSS image of this feed
     *
     * @var integer
     */
    protected $image_width;

    /**
     * The height of the RSS image of this feed
     *
     * @var integer
     */
    protected $image_height;

    /**
     * The iTunes author of this feed
     *
     * @var string
     */
    protected $itunes_author;

    /**
     * The iTunes email address of this feed
     *
     * @var string
     */
    protected $itunes_email;

    /**
     * The iTunes owner of this feed
     *
     * @var string
     */
    protected $itunes_owner;

    /**
     * The iTunes category of this feed
     *
     * @var string
     */
    protected $itunes_category;

    /**
     * The iTunes subcategories of this feed
     *
     * An array of strings.
     *
     * @var array
     */
    protected $itunes_subcategories = array();

    /**
     * The Atom web link of this feed
     *
     * @var string
     */
    protected $atom_link;

    /**
     * Whether or not this feed is marked explicit for iTunes
     *
     * @var boolean
     */
    protected $itunes_explicit = false;

    /**
     * Whether or not this feed should be blocked from the automatic listing
     * in iTunes
     *
     * @var boolean
     */
    protected $itunes_block = false;

    /**
     * The items of this feed
     *
     * An array of Castanet_Feed items.
     *
     * @var array
     */
    protected $items = array();

    // }}}
    // {{{ public function __construct()

    /**
     * Creates a new feed
     *
     * @param string $title       the title of the feed.
     * @param string $link        the web link of the feed.
     * @param string $description the description of the feed.
     */
    public function __construct($title, $link, $description)
    {
        $this->setTitle($title);
        $this->setLink($link);
        $this->setDescription($description);
    }

    // }}}
    // {{{ public function setTitle()

    /**
     * Sets the title of this feed
     *
     * @param string $title the title of this feed.
     *
     * @return null
     */
    public function setTitle($title)
    {
        $this->title = strval($title);
    }

    // }}}
    // {{{ public function setLink()

    /**
     * Sets the web link of this feed
     *
     * @param string $link the web link of this feed.
     *
     * @return null
     */
    public function setLink($link)
    {
        $this->link = strval($link);
    }

    // }}}
    // {{{ public function setDescription()

    /**
     * Sets the description of this feed
     *
     * @param string $description the description of this feed.
     *
     * @return null
     */
    public function setDescription($description)
    {
        $this->description = strval($description);
    }

    // }}}
    // {{{ public function setLanguage()

    /**
     * Sets the language of this feed
     *
     * @param string $language the language of this feed. This should be a
     *                         2-digit ISO 629-1 code.
     *
     * @return null
     */
    public function setLanguage($language)
    {
        $this->language = strval($language);
    }

    // }}}
    // {{{ public function setCopyright()

    /**
     * Sets the copyright attribution of this feed
     *
     * @param string $copyright the copyright attribution of this feed.
     *
     * @return null
     */
    public function setCopyright($copyright)
    {
        $this->copyright = strval($copyright);
    }

    // }}}
    // {{{ public function setEditorEmail()

    /**
     * Sets the managing editor of this feed
     *
     * @param string $managing_editor the managing editor of this feed.
     *
     * @return null
     */
    public function setManagingEditor($managing_editor)
    {
        $this->managing_editor = strval($managing_editor);
    }

    // }}}
    // {{{ public function setItunesImage()

    /**
     * Sets the iTunes cover image of this feed
     *
     * @param string $url the iTunes cover image of this feed. This should
     *                    have minimum dimensions of 1400x1400 pixels and a
     *                    square aspect ratio.
     *
     * @return null
     */
    public function setItunesImage($url)
    {
        $this->itunes_image_url = strval($url);
    }

    // }}}
    // {{{ public function setImage()

    /**
     * Sets the RSS image of this feed
     *
     * @param string  $url    the RSS image of this feed. This should have
     *                        maximum dimensions of 144x400 pixels. A square
     *                        aspect ratio iis preferred byt not required.
     * @param integer $width  the width of the image in pixels.
     * @param integer $height the height of the image in pixels.
     *
     * @return null
     */
    public function setImage($url, $width, $height)
    {
        $this->image_url = strval($url);
        $this->image_width = intval($width);
        $this->image_height = intval($height);
    }

    // }}}
    // {{{ public function setItunesExplicit()

    /**
     * Sets whether or not this feed is marked as explicit in iTunes
     *
     * @param boolean $explicit true if this feed should be marked explicit,
     *                          otherwise false.
     *
     * @return null
     */
    public function setItunesExplicit($explicit)
    {
        $this->itunes_explicit = ($explicit) ? true : false;
    }

    // }}}
    // {{{ public function setItunesBlock()

    /**
     * Sets whether or not this feed is blocked from the public feed list in
     * the iTunes directory
     *
     * @param boolean $itunes_block true if this feed should be blocked from
     *                              the public iTunes directory, otherwise
     *                              false.
     *
     * @return null
     */
    public function setItunesBlock($itunes_block)
    {
        $this->itunes_block = ($itunes_block) ? true : false;
    }

    // }}}
    // {{{ public function setAtomLink()

    /**
     * Sets the self-referential URL for this feed
     *
     * @param string $atom_link the self-referential URL for this feed.
     *
     * @return void
     */
    public function setAtomLink($atom_link)
    {
        $this->atom_link = strval($atom_link);
    }

    // }}}
    // {{{ public function setItunesCategories()

    /**
     * Sets the iTunes category and subcategories for this feed
     *
     * Categories and subcategories must be selected from the list published
     * by Apple at https://help.apple.com/itc/podcasts_connect/?lang=en#/itc9267a2f12
     *
     * @param string $itunes_category      the itunes category.
     * @param array  $itunes_subcategories optional. An array of subcategories.
     *
     * @return void
     */
    public function setItunesCategories(
        $itunes_category,
        array $itunes_subcategories = array()
    ) {
        $this->itunes_category = $itunes_category;

        $this->itunes_subcategories = array();
        foreach ($itunes_subcategories as $subcategory) {
            $this->itunes_subcategories[] = strval($subcategory);
        }
    }

    // }}}
    // {{{ public function setItunesOwnerEmail()

    /**
     * Sets the email address of the owner of this feed
     *
     * @param string $itunes_email the email address of the owner of this feed.
     *
     * @return null
     */
    public function setItunesOwnerEmail($itunes_email)
    {
        $this->itunes_email = strval($itunes_email);
    }

    // }}}
    // {{{ public function setItunesOwner()

    /**
     * Sets the owner of this feed
     *
     * @param string $itunes_owner the owner of this feed.
     *
     * @return null
     */
    public function setItunesOwner($itunes_owner)
    {
        $this->itunes_owner = strval($itunes_owner);
    }

    // }}}
    // {{{ public function setItunesAuthor()

    /**
     * Sets the author of this feed
     *
     * @param string $itunes_author the author of this feed.
     *
     * @return null
     */
    public function setItunesAuthor($itunes_author)
    {
        $this->itunes_author = strval($itunes_author);
    }

    // }}}
    // {{{ public function addItem()

    /**
     * Adds an item to this feed
     *
     * @param Castanet_Item $item the item to add. It will appear after
     *                            existing items.
     *
     * @return null
     */
    public function addItem(Castanet_Item $item)
    {
        $this->items[] = $item;
    }

    // }}}
    // {{{ public function __toString()

    /**
     * Renders this feed to a string
     *
     * @return string this feed as a string containing a valid XML document.
     */
    public function __toString()
    {
        $document = new DOMDocument('1.0', 'utf-8');
        $document->formatOutput = true;

        $rss = $document->createElement('rss');
        $rss->setAttribute('version', Castanet::RSS_VERSION);
        $rss->setAttributeNS(
            Castanet::XMLNS_NAMESPACE,
            'xmlns:itunes',
            Castanet::ITUNES_NAMESPACE
        );

        $document->appendChild($rss);

        $this->build($rss);

        return $document->saveXML();
    }

    // }}}
    // {{{ public function build()

    /**
     * Builds this feed
     *
     * @param DOMNode $parent the parent node of this feed. Usually a document
     *                        node.
     *
     * @return void
     */
    public function build(DOMNode $parent)
    {
        $document = $parent->ownerDocument;

        $channel = $document->createElement('channel');
        $parent->appendChild($channel);

        $this->buildTitle($channel);
        $this->buildAtomLink($channel);
        $this->buildLink($channel);
        $this->buildDescription($channel);
        $this->buildLanguage($channel);
        $this->buildCopyright($channel);
        $this->buildImage($channel);
        $this->buildManagingEditor($channel);
        $this->buildItunesCategories($channel);
        $this->buildItunesAuthor($channel);
        $this->buildItunesOwner($channel);
        $this->buildItunesImage($channel);
        $this->buildItunesExplicit($channel);
        $this->buildItunesBlock($channel);
        $this->buildItems($channel);
    }

    // }}}
    // {{{ protected function buildTitle()

    /**
     * Builds the title element of this feed
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     *
     * @return void
     */
    protected function buildTitle(DOMNode $parent)
    {
        $document = $parent->ownerDocument;

        $text = $document->createTextNode($this->title);
        $node = $document->createElement('title');

        $node->appendChild($text);
        $parent->appendChild($node);
    }

    // }}}
    // {{{ protected function buildLink()

    /**
     * Builds the link element of this feed
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     *
     * @return void
     */
    protected function buildLink(DOMNode $parent)
    {
        $document = $parent->ownerDocument;

        $text = $document->createTextNode($this->link);
        $node = $document->createElement('link');

        $node->appendChild($text);
        $parent->appendChild($node);
    }

    // }}}
    // {{{ protected function buildManagingEditor()

    /**
     * Builds the managing editor element of this feed
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     *
     * @return void
     */
    protected function buildManagingEditor(DOMNode $parent)
    {
        if ($this->managing_editor != '') {
            $document = $parent->ownerDocument;

            $text = $document->createTextNode($this->managing_editor);
            $node = $document->createElement('managingEditor');

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    // }}}
    // {{{ protected function buildItunesOwner()

    /**
     * Builds the owner element of this feed
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     *
     * @return void
     */
    protected function buildItunesOwner(DOMNode $parent)
    {
        if ($this->itunes_email != '' || $this->itunes_owner != '') {
            $document = $parent->ownerDocument;

            $node = $document->createElementNS(
                Castanet::ITUNES_NAMESPACE,
                'owner'
            );

            if ($this->itunes_email != '') {
                $text = $document->createTextNode($this->itunes_email);
                $child_node = $document->createElementNS(
                    Castanet::ITUNES_NAMESPACE,
                    'email'
                );
                $child_node->appendChild($text);
                $node->appendChild($child_node);
            }

            if ($this->itunes_owner != '') {
                $text = $document->createTextNode($this->itunes_owner);
                $child_node = $document->createElementNS(
                    Castanet::ITUNES_NAMESPACE,
                    'name'
                );
                $child_node->appendChild($text);
                $node->appendChild($child_node);
            }

            $parent->appendChild($node);
        }
    }

    // }}}
    // {{{ protected function buildItunesCategories()

    /**
     * Builds the category elements of this feed
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     *
     * @return void
     */
    protected function buildItunesCategories(DOMNode $parent)
    {
        $document = $parent->ownerDocument;
        $node = $document->createElementNS(
            Castanet::ITUNES_NAMESPACE,
            'category'
        );
        $node->setAttribute('text', $this->itunes_category);
        $parent->appendChild($node);

        foreach ($this->itunes_subcategories as $subcategory) {
            $child_node = $document->createElementNS(
                Castanet::ITUNES_NAMESPACE,
                'category'
            );

            $child_node->setAttribute('text', $subcategory);
            $node->appendChild($child_node);
        }
    }

    // }}}
    // {{{ protected function buildItunesAuthor()

    /**
     * Builds the author element of this feed
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     *
     * @return void
     */
    protected function buildItunesAuthor(DOMNode $parent)
    {
        if ($this->itunes_author != '') {
            $document = $parent->ownerDocument;

            $text = $document->createTextNode($this->itunes_author);
            $node = $document->createElementNS(
                Castanet::ITUNES_NAMESPACE,
                'author'
            );

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    // }}}
    // {{{ protected function buildAtomLink()

    /**
     * Builds the Atom link element of this feed
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     *
     * @return void
     */
    protected function buildAtomLink(DOMNode $parent)
    {
        if ($this->atom_link != '') {
            $document = $parent->ownerDocument;

            $node = $document->createElementNS(
                Castanet::ATOM_NAMESPACE,
                'link'
            );
            $node->setAttribute('href', $this->atom_link);
            $node->setAttribute('rel', 'self');
            $node->setAttribute('type', 'application/rss+xml');

            $parent->appendChild($node);
        }
    }

    // }}}
    // {{{ protected function buildDescription()

    /**
     * Builds the description element of this feed
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     *
     * @return void
     */
    protected function buildDescription(DOMNode $parent)
    {
        $document = $parent->ownerDocument;

        // description
        $node = $document->createElement('description');
        $text = $document->createCDATASection($this->description);

        $node->appendChild($text);
        $parent->appendChild($node);

        // itunes:summary
        $node = $document->createElementNS(
            Castanet::ITUNES_NAMESPACE,
            'summary'
        );

        $text = $document->createCDATASection($this->description);

        $node->appendChild($text);

        $parent->appendChild($node);
    }

    // }}}
    // {{{ protected function buildLanguage()

    /**
     * Builds the language element of this feed
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     *
     * @return void
     */
    protected function buildLanguage(DOMNode $parent)
    {
        if ($this->language != '') {
            $document = $parent->ownerDocument;

            $text = $document->createTextNode($this->language);
            $node = $document->createElement('language');

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    // }}}
    // {{{ protected function buildCopyright()

    /**
     * Builds the copyright attribution element of this feed
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     *
     * @return void
     */
    protected function buildCopyright(DOMNode $parent)
    {
        if ($this->copyright != '') {
            $document = $parent->ownerDocument;

            $text = $document->createTextNode($this->copyright);
            $node = $document->createElement('copyright');

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    // }}}
    // {{{ protected function buildItunesExplicit()

    /**
     * Builds the iTunes explicit element of this feed
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     *
     * @return void
     */
    protected function buildItunesExplicit(DOMNode $parent)
    {
        $document = $parent->ownerDocument;

        $node = $document->createElementNS(
            Castanet::ITUNES_NAMESPACE,
            'explicit',
            ($this->itunes_explicit) ? 'yes' : 'no'
        );

        $parent->appendChild($node);
    }

    // }}}
    // {{{ protected function buildItunesBlock()

    /**
     * Builds the iTunes block element of this feed
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     *
     * @return void
     */
    protected function buildItunesBlock(DOMNode $parent)
    {
        $document = $parent->ownerDocument;

        $node = $document->createElementNS(
            Castanet::ITUNES_NAMESPACE,
            'block',
            ($this->itunes_block) ? 'yes' : 'no'
        );

        $parent->appendChild($node);
    }

    // }}}
    // {{{ protected function buildItunesImage()

    /**
     * Builds the iTunes image element of this feed
     *
     * @param DOMNode $parent the parent node. Usually the channel.
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
    // {{{ protected function buildImage()

    /**
     * Builds the image element of this feed
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     *
     * @return void
     */
    protected function buildImage(DOMNode $parent)
    {
        // The standard RSS image element should be a max of 144x400px
        if ($this->image_url != '') {
            $document = $parent->ownerDocument;

            $image_node = $document->createElement('image');
            $parent->appendChild($image_node);

            $node = $document->createElement('url', $this->image_url);
            $image_node->appendChild($node);

            $title = $document->createTextNode($this->title);
            $node = $document->createElement('title');
            $node->appendChild($title);
            $image_node->appendChild($node);

            $link = $document->createTextNode($this->link);
            $node = $document->createElement('link');
            $node->appendChild($link);
            $image_node->appendChild($node);

            $width = $document->createTextNode($this->image_width);
            $node = $document->createElement('width');
            $node->appendChild($width);
            $image_node->appendChild($node);

            $height = $document->createTextNode($this->image_height);
            $node = $document->createElement('height');
            $node->appendChild($height);
            $image_node->appendChild($node);
        }
    }

    // }}}
    // {{{ protected function buildItems()

    /**
     * Builds the item elements of this feed
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     *
     * @return void
     */
    protected function buildItems(DOMNode $parent)
    {
        foreach ($this->items as $item) {
            $item->build($parent);
        }
    }

    // }}}
}

?>
