<?php

require_once 'Castanet.php';
require_once 'Castanet/Item.php';

/**
 * Class used to generate a podcast.
 *
 * @package   Castanet
 * @author    Michael Gauthier <mike@silverorange.com>
 * @author    Charles Waddell <charles@silverorange.com>
 * @copyright 2011-2014 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class Castanet_Feed
{
	// {{{ protected properties

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $link;

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * @var string
	 */
	protected $language;

	/**
	 * @var string
	 */
	protected $copyright;

	/**
	 * @var string
	 */
	protected $managing_editor;

	/**
	 * @var string
	 */
	protected $itunes_author;

	/**
	 * @var boolean
	 */
	protected $itunes_explicit = false;

	/**
	 * @var boolean
	 */
	protected $itunes_block = false;

	/**
	 * @var array
	 */
	protected $items = array();

	// }}}
	// {{{ public function __construct()

	public function __construct($title, $link, $description)
	{
		$this->setTitle($title);
		$this->setLink($link);
		$this->setDescription($description);
	}

	// }}}
	// {{{ public function setTitle()

	public function setTitle($title)
	{
		$this->title = strval($title);
	}

	// }}}
	// {{{ public function setLink()

	public function setLink($link)
	{
		$this->link = strval($link);
	}

	// }}}
	// {{{ public function setDescription()

	public function setDescription($description)
	{
		$this->description = strval($description);
	}

	// }}}
	// {{{ public function setLanguage()

	public function setLanguage($language)
	{
		$this->language = strval($language);
	}

	// }}}
	// {{{ public function setCopyright()

	public function setCopyright($copyright)
	{
		$this->copyright = strval($copyright);
	}

	// }}}
	// {{{ public function setEditorEmail()

	public function setManagingEditor($managing_editor)
	{
		$this->managing_editor = strval($managing_editor);
	}

	// }}}
	// {{{ public function setImage()

	public function setImage($url, $width, $height)
	{
		$this->image_url = strval($url);
		$this->image_width = intval($width);
		$this->image_height = intval($height);
	}

	// }}}
	// {{{ public function setItunesExplicit()

	public function setItunesExplicit($explicit)
	{
		$this->itunes_explicit = ($explicit) ? true : false;
	}

	// }}}
	// {{{ public function setItunesBlock()

	public function setItunesBlock($itunes_block)
	{
		$this->itunes_block = ($itunes_block) ? true : false;
	}

	// }}}
	// {{{ public function setItunesAuthor()

	public function setItunesAuthor($itunes_author)
	{
		$this->itunes_author = strval($itunes_author);
	}

	// }}}
	// {{{ public function addItem()

	public function addItem(Castanet_Item $item)
	{
		$this->items[] = $item;
	}

	// }}}
	// {{{ public function __toString()

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

	public function build(DOMNode $parent)
	{
		$document = $parent->ownerDocument;

		$channel = $document->createElement('channel');
		$parent->appendChild($channel);

		$this->buildTitle($channel);
		$this->buildLink($channel);
		$this->buildDescription($channel);
		$this->buildLanguage($channel);
		$this->buildCopyright($channel);
		$this->buildImage($channel);
		$this->buildManagingEditor($channel);
		$this->buildItunesAuthor($channel);
		$this->buildItunesImage($channel);
		$this->buildItunesExplicit($channel);
		$this->buildItunesBlock($channel);
		$this->buildItems($channel);
	}

	// }}}
	// {{{ protected function buildTitle()

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

	protected function buildLink(DOMNode $parent)
	{
		$document = $parent->ownerDocument;

		$node = $document->createElement('link', $this->link);
		$parent->appendChild($node);
	}

	// }}}
	// {{{ protected function buildManagingEditor()

	protected function buildManagingEditor(DOMNode $parent)
	{
		if ($this->managing_editor != '') {
			$document = $parent->ownerDocument;

			$node = $document->createElement(
				'managingEditor',
				$this->managing_editor
			);

			$parent->appendChild($node);
		}
	}

	// }}}
	// {{{ protected function buildItunesAuthor()

	protected function buildItunesAuthor(DOMNode $parent)
	{
		if ($this->itunes_author != '') {
			$document = $parent->ownerDocument;

			$node = $document->createElementNS(
				Castanet::ITUNES_NAMESPACE,
				'author',
				$this->itunes_author
			);

			$parent->appendChild($node);
		}
	}

	// }}}
	// {{{ protected function buildDescription()

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

	protected function buildLanguage(DOMNode $parent)
	{
		$document = $parent->ownerDocument;

		if ($this->language != '') {
			$node = $document->createElement('language', $this->language);
			$parent->appendChild($node);
		}
	}

	// }}}
	// {{{ protected function buildCopyright()

	protected function buildCopyright(DOMNode $parent)
	{
		$document = $parent->ownerDocument;

		if ($this->copyright != '') {
			$node = $document->createElement('copyright', $this->copyright);
			$parent->appendChild($node);
		}
	}

	// }}}
	// {{{ protected function buildItunesExplicit()

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

	protected function buildItunesImage(DOMNode $parent)
	{
		if ($this->image_url != '') {
			$document = $parent->ownerDocument;

			$node = $document->createElementNS(
				Castanet::ITUNES_NAMESPACE,
				'image',
				$this->image_url
			);

			$parent->appendChild($node);
		}
	}

	// }}}
	// {{{ protected function buildImage()

	protected function buildImage(DOMNode $parent)
	{
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

			$node = $document->createElement('link', $this->link);
			$image_node->appendChild($node);

			$node = $document->createElement('width', $this->image_width);
			$image_node->appendChild($node);

			$node = $document->createElement('height', $this->image_height);
			$image_node->appendChild($node);
		}
	}

	// }}}
	// {{{ protected function buildItems()

	protected function buildItems(DOMNode $parent)
	{
		foreach ($this->items as $item) {
			$item->build($parent);
		}
	}

	// }}}
}

?>
