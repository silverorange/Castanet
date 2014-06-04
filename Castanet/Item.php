<?php

require_once 'Castanet.php';

/**
 * Class used to generate individual items in a podcast.
 *
 * @package   Castanet
 * @author    Michael Gauthier <mike@silverorange.com>
 * @author    Charles Waddell <charles@silverorange.com>
 * @copyright 2011-2014 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class Castanet_Item
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
	protected $publish_date;

	/**
	 * @var string
	 */
	protected $media_url;

	/**
	 * @var integer
	 */
	protected $media_size;

	/**
	 * @var string
	 */
	protected $media_mime_type;

	/**
	 * @var integer
	 */
	protected $media_duration;

	/**
	 * @var string
	 */
	protected $itunes_subtitle;

	/**
	 * @var string
	 */
	protected $itunes_summary;

	/**
	 * @var string
	 */
	protected $guid;

	/**
	 * @var boolean
	 */
	protected $guid_is_permalink = true;

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
	// {{{ public function setGuid()

	public function setGuid($guid, $is_permalink = true)
	{
		$this->guid = strval($guid);
		$this->guid_is_permalink = ($is_permalink) ? true : false;
	}

	// }}}
	// {{{ public function setDescription()

	public function setDescription($description)
	{
		$this->description = strval($description);
	}

	// }}}
	// {{{ public function setPublishDate()

	public function setPublishDate($date)
	{
		if ($date instanceof DateTime) {
			$date = $date->format('r');
		}
		$this->publish_date = $date;
	}

	// }}}
	// {{{ public function setMediaUrl()

	public function setMediaUrl($url)
	{
		$this->media_url = strval($url);
	}

	// }}}
	// {{{ public function setMediaSize()

	public function setMediaSize($size)
	{
		$this->media_size = intval($size);
	}

	// }}}
	// {{{ public function setMediaMimeType()

	public function setMediaMimeType($mime_type)
	{
		$this->media_mime_type = strval($mime_type);
	}

	// }}}
	// {{{ public function setMediaDuration()

	public function setMediaDuration($duration)
	{
		$this->media_duration = intval($duration);
	}

	// }}}
	// {{{ public function setItunesSubtitle()

	public function setItunesSubtitle($subtitle)
	{
		$this->itunes_subtitle = strval($subtitle);
	}

	// }}}
	// {{{ public function setItunesSummary()

	public function setItunesSummary($summary)
	{
		$this->itunes_summary = strval($summary);
	}

	// }}}
	// {{{ public function build()

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
		$this->buildDescription($item);
		$this->buildPublishDate($item);
		$this->buildMediaEnclosure($item);
		$this->buildMediaDuration($item);
	}

	// }}}
	// {{{ protected function buildTitle()

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

	protected function buildGuid(DOMNode $parent)
	{
		if ($this->guid != '') {
			$document = $parent->ownerDocument;

			$text = $document->createTextNode($this->guid);
			$node = $document->createElement('guid');

			if (!$this->guid_is_permalink) {
				$node->setAttribute('isPermalink', 'false');
			}

			$node->appendChild($text);
			$parent->appendChild($node);
		}
	}

	// }}}
	// {{{ protected function buildItunesSubtitle()

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
	// {{{ protected function buildDescription()

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
