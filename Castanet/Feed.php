<?php

require_once 'Castanet.php';
require_once 'Castanet/Item.php';

/**
 * Class used to generate a podcast.
 *
 * @package   Castanet
 * @author    Michael Gauthier <mike@silverorange.com>
 * @author    Charles Waddell <charles@silverorange.com>
 * @copyright 2011-2016 silverorange
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
	protected $itunes_image_url;

	/**
	 * @var string
	 */
	protected $image_url;

	/**
	 * @var integer
	 */
	protected $image_width;

	/**
	 * @var integer
	 */
	protected $image_height;

	/**
	 * @var string
	 */
	protected $itunes_author;

	/**
	 * @var string
	 */
	protected $itunes_email;

	/**
	 * @var string
	 */
	protected $itunes_owner;

	/**
	 * @var array
	 */
	protected $itunes_categories = array();

	/**
	 * @var string
	 */
	protected $itunes_subcategory;

	/**
	 * @var string
	 */
	protected $atom_link;

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
	// {{{ public function setItunesImage()

	public function setItunesImage($url)
	{
		// For Apple-sized images (1400x1400 px and up, always square)
		$this->itunes_image_url = strval($url);
	}

	// }}}
	// {{{ public function setImage()

	public function setImage($url, $width, $height)
	{
		// For standard RSS images (max 144x400 px)
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
	// {{{ public function setAtomLink()

	public function setAtomLink($atom_link)
	{
		$this->atom_link = strval($atom_link);
	}

	// }}}
	// {{{ public function setItunesCategories()

	public function setItunesCategories($itunes_categories)
	{
		$this->itunes_categories = array();
		foreach($itunes_categories as $subcategory){
			$this->itunes_categories[] = strval($subcategory);
		}
	}

	// }}}
	// {{{ public function setItunesOwnerEmail()

	public function setItunesOwnerEmail($itunes_email)
	{
		$this->itunes_email = strval($itunes_email);
	}

	// }}}
	// {{{ public function setItunesOwner()

	public function setItunesOwner($itunes_owner)
	{
		$this->itunes_owner = strval($itunes_owner);
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

		$text = $document->createTextNode($this->link);
		$node = $document->createElement('link');

		$node->appendChild($text);
		$parent->appendChild($node);
	}

	// }}}
	// {{{ protected function buildManagingEditor()

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

	protected function buildItunesCategories(DOMNode $parent)
	{
		$document = $parent->ownerDocument;
		foreach($this->itunes_categories as $subcategory){
			$child_node = $document->createElementNS(
				Castanet::ITUNES_NAMESPACE,
				'category'
			);

			$child_node->setAttribute('text', $subcategory); 
			$parent->appendChild($child_node);
			$parent = $child_node;
		}
	}

	// }}}
	// {{{ protected function buildItunesAuthor()

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

	protected function buildItems(DOMNode $parent)
	{
		foreach ($this->items as $item) {
			$item->build($parent);
		}
	}

	// }}}
}

?>
