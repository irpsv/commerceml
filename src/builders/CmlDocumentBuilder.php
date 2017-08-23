<?php

namespace irpsv\commerceml\docs\builders;

class CmlDocumentBuilder
{
	protected $node;

	public function __construct(\DOMNode $node)
	{
		$this->node = $node;
	}

	public function build()
	{
		$rootNode = $this->node->firstChild;
		if (!$rootNode) {
			throw new \Exception("Root node not found");
		}
		switch ($rootNode->nodeName) {
			case 'КоммерческаяИнформация':
				return (new CommerceInfoBuilder($rootNode))->build();

			default:
				throw new \Exception("Root node type of '{$rootNode->nodeName}' is not found");
		}
	}
}
