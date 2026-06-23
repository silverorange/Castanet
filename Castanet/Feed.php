<?php

/**
 * This file contains the feed object for the Castanet package.
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
 * Class used to generate a podcast.
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
class Castanet_Feed implements \Stringable
{
    /**
     * The title of this feed.
     *
     * @var string
     */
    protected $title;

    /**
     * The web link of this feed.
     *
     * @var string
     */
    protected $link;

    /**
     * The description of this feed.
     *
     * @var string
     */
    protected $description;

    /**
     * The ISO 629-1 language of this feed.
     *
     * @var string
     */
    protected $language;

    /**
     * The copyright attribution of this feed.
     *
     * @var string
     */
    protected $copyright;

    /**
     * The managing editor of this feed.
     *
     * @var string
     */
    protected $managing_editor;

    /**
     * The iTunes cover image of this feed.
     *
     * @var string
     */
    protected $itunes_image_url;

    /**
     * The RSS image of this feed.
     *
     * @var string
     */
    protected $image_url;

    /**
     * The width of the RSS image of this feed.
     *
     * @var int
     */
    protected $image_width;

    /**
     * The height of the RSS image of this feed.
     *
     * @var int
     */
    protected $image_height;

    /**
     * The iTunes author of this feed.
     *
     * @var string
     */
    protected $itunes_author;

    /**
     * The iTunes email address of this feed.
     *
     * @var string
     */
    protected $itunes_email;

    /**
     * The iTunes owner of this feed.
     *
     * @var string
     */
    protected $itunes_owner;

    /**
     * The iTunes category of this feed.
     *
     * @var string
     */
    protected $itunes_category;

    /**
     * The iTunes subcategories of this feed.
     *
     * An array of strings.
     *
     * @var list<string>
     */
    protected array $itunes_subcategories = [];

    /**
     * The Atom web link of this feed.
     *
     * @var string
     */
    protected $atom_link;

    /**
     * Whether or not this feed is marked explicit for iTunes.
     */
    protected bool $itunes_explicit = false;

    /**
     * Whether or not this feed should be blocked from the automatic listing
     * in iTunes.
     */
    protected bool $itunes_block = false;

    /**
     * The items of this feed.
     *
     * An array of Castanet_Feed items.
     *
     * @var list<Castanet_Item>
     */
    protected array $items = [];

    /**
     * Creates a new feed.
     *
     * @param string $title       the title of the feed
     * @param string $link        the web link of the feed
     * @param string $description the description of the feed
     */
    public function __construct($title, $link, $description)
    {
        $this->setTitle($title);
        $this->setLink($link);
        $this->setDescription($description);
    }

    /**
     * Sets the title of this feed.
     *
     * @param string $title the title of this feed
     */
    public function setTitle($title): void
    {
        $this->title = strval($title);
    }

    /**
     * Sets the web link of this feed.
     *
     * @param string $link the web link of this feed
     */
    public function setLink($link): void
    {
        $this->link = strval($link);
    }

    /**
     * Sets the description of this feed.
     *
     * @param string $description the description of this feed
     */
    public function setDescription($description): void
    {
        $this->description = strval($description);
    }

    /**
     * Sets the language of this feed.
     *
     * @param string $language the language of this feed. This should be a
     *                         2-digit ISO 629-1 code.
     */
    public function setLanguage($language): void
    {
        $this->language = strval($language);
    }

    /**
     * Sets the copyright attribution of this feed.
     *
     * @param string $copyright the copyright attribution of this feed
     */
    public function setCopyright($copyright): void
    {
        $this->copyright = strval($copyright);
    }

    /**
     * Sets the managing editor of this feed.
     *
     * @param string $managing_editor the managing editor of this feed
     */
    public function setManagingEditor($managing_editor): void
    {
        $this->managing_editor = strval($managing_editor);
    }

    /**
     * Sets the iTunes cover image of this feed.
     *
     * @param string $url the iTunes cover image of this feed. This should
     *                    have minimum dimensions of 1400x1400 pixels and a
     *                    square aspect ratio.
     */
    public function setItunesImage($url): void
    {
        $this->itunes_image_url = strval($url);
    }

    /**
     * Sets the RSS image of this feed.
     *
     * @param string $url    the RSS image of this feed. This should have
     *                       maximum dimensions of 144x400 pixels. A square
     *                       aspect ratio iis preferred byt not required.
     * @param int    $width  the width of the image in pixels
     * @param int    $height the height of the image in pixels
     */
    public function setImage($url, $width, $height): void
    {
        $this->image_url = strval($url);
        $this->image_width = intval($width);
        $this->image_height = intval($height);
    }

    /**
     * Sets whether or not this feed is marked as explicit in iTunes.
     *
     * @param bool $explicit true if this feed should be marked explicit,
     *                       otherwise false
     */
    public function setItunesExplicit($explicit): void
    {
        $this->itunes_explicit = ($explicit) ? true : false;
    }

    /**
     * Sets whether or not this feed is blocked from the public feed list in
     * the iTunes directory.
     *
     * @param bool $itunes_block true if this feed should be blocked from
     *                           the public iTunes directory, otherwise
     *                           false
     */
    public function setItunesBlock($itunes_block): void
    {
        $this->itunes_block = ($itunes_block) ? true : false;
    }

    /**
     * Sets the self-referential URL for this feed.
     *
     * @param string $atom_link the self-referential URL for this feed
     */
    public function setAtomLink($atom_link): void
    {
        $this->atom_link = strval($atom_link);
    }

    /**
     * Sets the iTunes category and subcategories for this feed.
     *
     * Categories and subcategories must be selected from the list published
     * by Apple at https://help.apple.com/itc/podcasts_connect/?lang=en#/itc9267a2f12
     *
     * @param string        $itunes_category      the itunes category
     * @param array<string> $itunes_subcategories optional. An array of subcategories.
     */
    public function setItunesCategories(
        $itunes_category,
        array $itunes_subcategories = []
    ): void {
        $this->itunes_category = $itunes_category;

        $this->itunes_subcategories = [];
        foreach ($itunes_subcategories as $subcategory) {
            $this->itunes_subcategories[] = strval($subcategory);
        }
    }

    /**
     * Sets the email address of the owner of this feed.
     *
     * @param string $itunes_email the email address of the owner of this feed
     */
    public function setItunesOwnerEmail($itunes_email): void
    {
        $this->itunes_email = strval($itunes_email);
    }

    /**
     * Sets the owner of this feed.
     *
     * @param string $itunes_owner the owner of this feed
     */
    public function setItunesOwner($itunes_owner): void
    {
        $this->itunes_owner = strval($itunes_owner);
    }

    /**
     * Sets the author of this feed.
     *
     * @param string $itunes_author the author of this feed
     */
    public function setItunesAuthor($itunes_author): void
    {
        $this->itunes_author = strval($itunes_author);
    }

    /**
     * Adds an item to this feed.
     *
     * @param Castanet_Item $item the item to add. It will appear after
     *                            existing items.
     */
    public function addItem(Castanet_Item $item): void
    {
        $this->items[] = $item;
    }

    /**
     * Builds this feed.
     *
     * @param DOMNode $parent the parent node of this feed. Usually a document
     *                        node.
     */
    public function build(DOMNode $parent): void
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

    /**
     * Builds the title element of this feed.
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     */
    protected function buildTitle(DOMNode $parent): void
    {
        $document = $parent->ownerDocument;

        $text = $document->createTextNode($this->title);
        $node = $document->createElement('title');

        $node->appendChild($text);
        $parent->appendChild($node);
    }

    /**
     * Builds the link element of this feed.
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     */
    protected function buildLink(DOMNode $parent): void
    {
        $document = $parent->ownerDocument;

        $text = $document->createTextNode($this->link);
        $node = $document->createElement('link');

        $node->appendChild($text);
        $parent->appendChild($node);
    }

    /**
     * Builds the managing editor element of this feed.
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     */
    protected function buildManagingEditor(DOMNode $parent): void
    {
        if ($this->managing_editor != '') {
            $document = $parent->ownerDocument;

            $text = $document->createTextNode($this->managing_editor);
            $node = $document->createElement('managingEditor');

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    /**
     * Builds the owner element of this feed.
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     */
    protected function buildItunesOwner(DOMNode $parent): void
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

    /**
     * Builds the category elements of this feed.
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     */
    protected function buildItunesCategories(DOMNode $parent): void
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

    /**
     * Builds the author element of this feed.
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     */
    protected function buildItunesAuthor(DOMNode $parent): void
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

    /**
     * Builds the Atom link element of this feed.
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     */
    protected function buildAtomLink(DOMNode $parent): void
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

    /**
     * Builds the description element of this feed.
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     */
    protected function buildDescription(DOMNode $parent): void
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

    /**
     * Builds the language element of this feed.
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     */
    protected function buildLanguage(DOMNode $parent): void
    {
        if ($this->language != '') {
            $document = $parent->ownerDocument;

            $text = $document->createTextNode($this->language);
            $node = $document->createElement('language');

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    /**
     * Builds the copyright attribution element of this feed.
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     */
    protected function buildCopyright(DOMNode $parent): void
    {
        if ($this->copyright != '') {
            $document = $parent->ownerDocument;

            $text = $document->createTextNode($this->copyright);
            $node = $document->createElement('copyright');

            $node->appendChild($text);
            $parent->appendChild($node);
        }
    }

    /**
     * Builds the iTunes explicit element of this feed.
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     */
    protected function buildItunesExplicit(DOMNode $parent): void
    {
        $document = $parent->ownerDocument;

        $node = $document->createElementNS(
            Castanet::ITUNES_NAMESPACE,
            'explicit',
            ($this->itunes_explicit) ? 'yes' : 'no'
        );

        $parent->appendChild($node);
    }

    /**
     * Builds the iTunes block element of this feed.
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     */
    protected function buildItunesBlock(DOMNode $parent): void
    {
        $document = $parent->ownerDocument;

        $node = $document->createElementNS(
            Castanet::ITUNES_NAMESPACE,
            'block',
            ($this->itunes_block) ? 'yes' : 'no'
        );

        $parent->appendChild($node);
    }

    /**
     * Builds the iTunes image element of this feed.
     *
     * @param DOMNode $parent the parent node. Usually the channel.
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
     * Builds the image element of this feed.
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     */
    protected function buildImage(DOMNode $parent): void
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

            $width = $document->createTextNode(strval($this->image_width));
            $node = $document->createElement('width');
            $node->appendChild($width);
            $image_node->appendChild($node);

            $height = $document->createTextNode(strval($this->image_height));
            $node = $document->createElement('height');
            $node->appendChild($height);
            $image_node->appendChild($node);
        }
    }

    /**
     * Builds the item elements of this feed.
     *
     * @param DOMNode $parent the parent node. Usually the channel.
     */
    protected function buildItems(DOMNode $parent): void
    {
        foreach ($this->items as $item) {
            $item->build($parent);
        }
    }

    /**
     * Renders this feed to a string.
     *
     * @return string this feed as a string containing a valid XML document
     */
    public function __toString(): string
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

        return $document->saveXML() ?: '';
    }
}
