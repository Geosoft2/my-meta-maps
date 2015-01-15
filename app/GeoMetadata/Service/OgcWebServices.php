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

namespace GeoMetadata\Service;

abstract class OgcWebServices extends XmlParser {
	
	use SimpleFillModelTrait;
	
	/**
	 * Takes the user specified URL and builds the service (or base) url from it.
	 * 
	 * @param string $url URL
	 * @return string Base URL of the service
	 */
	public function getServiceUrl($url) {
		// For OGC based services we don't need to store the query parameters.
		// We always append the ? to the OGC base url.
		$index = strpos($url, '?');
		if ($index !== false) {
			return substr($url, 0, $index+1);
		}
		else {
			return $url . '?';
		}
	}
	
	/**
	 * Takes the user specified URL and builds the metadata url of the service from it.
	 * 
	 * @param string $url URL
	 * @return string URL giving the metadata for the service
	 */
	public function getMetadataUrl($url) {
		return $this->getServiceUrl($url) . "request=GetCapabilities&service=" . strtoupper($this->getCode());
	}
	
	protected function isWgs84($crs) {
		if (!is_array($crs)) {
			$crs = array($crs);
		}
		foreach($crs as $i) {
			$i = strtolower($i);
			if (\GeoMetadata\GmRegistry::getEpsgCodeNumber($i) == 4326) {
				return true;
			}
			else if ($i == 'crs:84' || $i == 'urn:ogc:def:crs:ogc:2:84' || $i = 'http://www.opengis.net/def/crs/ogc/1.3/crs84') { // crs:84 is mostly an alternative for EPSG:4326
				return true;
			}
		}
		return false;
	}

	public function verify($source) {
		return (parent::verify($source) && $this->getUsedNamespace());
	}

}