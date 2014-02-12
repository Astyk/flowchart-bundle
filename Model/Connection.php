<?php
/*
 * Flowchart: Bundle for wrapping and encapsulate the behaviour of the one flow chart
 * http://symfony.com/doc/current/cookbook/doctrine/resolve_target_entity.html
 *
 * Connection
 *
 * @author: Julio César Velasco <juceveju@gmail.com>
 *
 */

namespace Juceveju\FlowchartBundle\Model;

use Juceveju\FlowchartBundle\Model\Element;
use Juceveju\FlowchartBundle\Model\Ending;
use Juceveju\FlowchartBundle\Model\Entry;

class Connection implements ConnectionInterface
{

	protected $name;
	protected $id;
	protected $startElement;
	protected $endingElement;

	public function __construct(Element $startElement, Element $endElement, $name, $id=null){
		// the start and the end elements could be the same (cyclic connection)
		$this->setStartElement($startElement);
		$this->setEndElement($endElement);		
		$this->setName($name);
		$this->setId($id);
	}


    /**
     *
     * returns the id of the connection
     *
     * @return string
     */
	public function getId(){
		return $this->id;
	}	

	/**
	*
	* Set the id of the connection
 	*
	* @param string $id
	*/
	public function setId($id)
	{
		if (empty($id))
			$this->id = md5($this->name);
		else 
			$this->id = $id;
	}

	/**
	*
	* returns the name of the connection
	*
	* @return string
	*/
	public function getName()
	{
		return $this->name;
	}

	/**
	*
	* Set the name of the connection
 	*
	* @param string $name
	*/
	public function setName($name)
	{
		if(empty($name))
			throw new \Exception("The Connection name cannot be empty", 500);
		else		
			$this->name = $name;
	}

	/**
	*
	* set the intitial point of the connection
	*
	* @param Element $element
	*/
	public function setStartElement(Element $element)
	{
		if($element instanceof Ending)
			throw new \Exception("Ending element cannot be the origin of the connection", 500);		
		$this->startElement = $element;
	}

	/**
	*
	* returns the initial point of the connection
	*/
	public function getStartElement()
	{
		return $this->startElement;
	}

	/**
	*
	* set the ending point of the connection
	*
	* @param Element $element	
	*/
	public function setEndElement(Element $element)
	{
		if($element instanceof Entry)
			throw new \Exception("Entry element cannot be the end of the connection", 500);		
		$this->endingElement = $element;
	} 

	/**
	*
	* returns the ending point of the connection
	*/
	public function getEndElement()
	{
		return $this->endingElement;
	}
}
