<?php
/* 
 * Copyright 2014/15 Matthias Mohr
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

use \Carbon\Carbon;

/**
 * Extends the geodata model with the ability to be used as model in GeoMatadata Parser.
 */
class GmGeodata extends Geodata implements GeoMetadata\Model\Metadata, \GeoMetadata\Model\ExtraDataContainer {

	use GmGeodataBoundingBoxTrait, \GeoMetadata\Model\LayerContainerTrait, \GeoMetadata\Model\ExtraDataContainerTrait;

	/**
	 * Creates a new object of this class.
	 * 
	 * @return GmMetadata
	 */
	public function createObject() {
		return new static();
	}

	/**
	 * Returns a new instance of a class implementing the Layer interface and 
	 * which is is compatible with the implementation of metadata based class.
	 * 
	 * @return \GeoMetadata\Model\Layer
	 */
	public function deliverLayer() {
		return new GmGeodataLayer();
	}

	/**
	 * Returns the URL that has been specified.
	 * 
	 * Might not be set if the perser has been called using the metadata source and without any URL.
	 * 
	 * @return string|null
	 */
	public function getUrl(){
		return $this->url;
	}

	/**
	 * Sets the URL.
	 * 
	 * @param string|null $url URL
	 */
	public function setUrl($url){
		$this->url = $url;
	}

	/**
	 * Returns the service code that will be or has been used for parsing.
	 * 
	 * @return string|null
	 */
	public function getServiceCode(){
		return $this->datatype;
	}

	/**
	 * Sets the service code of the parser.
	 * 
	 * Has no impact for parsing, this does not set the parser for parsing.
	 * 
	 * @see \GeoMetadata\Service\Parser::getCode()
	 * @param string|null $service Service Code
	 */
	public function setServiceCode($service){
		$this->datatype = $service;
	}

	/**
	 * Returns the parsed title of the geo dataset.
	 * 
	 * @return string|null
	 */
	public function getTitle(){
		return $this->title;
	}

	/**
	 * Sets the title of the geo dataset.
	 * 
	 * @param string|null $title Title
	 */
	public function setTitle($title){
		$this->title = $title;
	}

	/**
	 * Returns the parsed description/abstract of the geo dataset.
	 * 
	 * @return string|null
	 */
	public function getAbstract(){
		return $this->abstract;
	}

	/**
	 * Sets the description/abstract of the geo dataset.
	 * 
	 * @param string|null $abstract Abstract
	 */
	public function setAbstract($abstract){
		$this->abstract = $abstract;
	}

	/**
	 * Returns the parsed language of the geo dataset.
	 * 
	 * This should be an ISO 639-1 based language code, but some parsers might return other types of data.
	 * 
	 * @return string|null
	 */
	public function getLanguage(){
		return $this->language;
	}

	/**
	 * Sets the language of the geo dataset.
	 * 
	 * This should be an ISO 639-1 based language code, but some parsers might return other types of data.
	 * 
	 * @param string|null $language ISO 639-1 language code
	 */
	public function setLanguage($language){
		$this->language = $language;
	}

	/**
	 * Returns the parsed author/service provider of the geo dataset.
	 * 
	 * @return string|null
	 */
	public function getAuthor(){
		return $this->author;
	}

	/**
	 * Sets the author/service provider of the geo dataset.
	 * 
	 * @param string|null $author Author information
	 */
	public function setAuthor($author){
		$this->author = $author;
	}

	/**
	 * Returns the parsed copyright notice of the geo dataset.
	 * 
	 * @return string|null
	 */
	public function getCopyright(){
		return $this->copyright;
	}

	/**
	 * Sets the copyright notice of the geo dataset.
	 * 
	 * @param string|null $copyright Copyright notice
	 */
	public function setCopyright($copyright){
		$this->copyright = $copyright;
	}

	/**
	 * Returns the parsed licensing information of the geo dataset.
	 * 
	 * @return string|null
	 */
	public function getLicense() {
		return $this->license;
	}

	/**
	 * Sets the licensing information of the geo dataset.
	 * 
	 * @param string|null $license License
	 */
	public function setLicense($license) {
		$this->license = $license;
	}

	/**
	 * Returns the parsed minimum timestamp of the geo dataset.
	 * 
	 * @return \DateTime|null
	 */
	public function getBeginTime(){
		return $this->start;
	}

	/**
	 * Sets the minimum timestamp of the geo dataset.
	 * 
	 * @param \DateTime|null $begin
	 */
	public function setBeginTime(\DateTime $begin = null){
		$this->start = $begin !== null ? Carbon::instance($begin) : null;
	}

	/**
	 * Returns the parsed maximum timestamp of the geo dataset.
	 * 
	 * @return \DateTime|null
	 */
	public function getEndTime(){
		return $this->end;
	}

	/**
	 * Sets the maximum timestamp of the geo dataset.
	 * 
	 * @param \DateTime|null $end
	 */
	public function setEndTime(\DateTime $end = null){
		$this->end = $end !== null ? Carbon::instance($end) : null;
	}

}
