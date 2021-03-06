<div class="col-md-8 column hundred">
	<div id="map"></div>
</div>

<div class="col-md-4 column hundred" id="mapDataPanel">

	<form class="panel panel-default">
		<div class="panel-heading" role="tab" id="filterHeader">
			<h4 class="panel-title clearfix">
				<a data-toggle="collapse" href="#filterArea" aria-expanded="true" aria-controls="filterArea">@lang('misc.setFilter')</a>
				<span class="filter-progress"></span>
				<button onclick="resetSearch(this.form)" type="button" class="btn btn-default btn-xs pull-right">
					<span class="glyphicon glyphicon-remove"></span>
					@lang('misc.reset')
				</button>
			</h4>
		</div>
		<div id="filterArea" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filterHeader">
			<div class="panel-body">

				<div class="form-group clearfix col-md-12 column">
					<div class="pull-right"><input type="checkbox" name="metadata" id="includeMetadata" onchange="executeSearch()"> <label for="includeMetadata" class="label-metadata">@lang('misc.metaUse')</label></div>
					<label class="label-filter">@lang('misc.search')</label>
					<div class="input-group">
						<input type="text" class="form-control" id="SearchTerms" placeholder="@lang('misc.searchTerm')" onchange="executeSearch()">
						<span class="input-group-addon" onclick="executeSearch()"><span class="glyphicon glyphicon-search"></span></span>
					</div>
				</div>

				<div class="form-group clearfix">
					<div class="input-group col-md-12 column">
						<label class="label-filter">@lang('misc.startEnd')</label>
					</div>
					<div class="input-group col-md-6 column">
						<span id="show-datepicker-start" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						<input class="form-control" type="text" id="filterStartTime" placeholder=" @lang('misc.startingDate') ({{ Config::get('view.datepicker.placeholder') }})" datepicker data-date-format="{{ Config::get('view.datepicker.format') }}" data-trigger="#show-datepicker-start" onchange="executeSearch()">
					</div>
					<div class="input-group col-md-6 column">
						<span id="show-datepicker-end" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						<input class="form-control" type="text" id="filterEndTime" placeholder=" @lang('misc.endingDate') ({{ Config::get('view.datepicker.placeholder') }})" datepicker data-date-format="{{ Config::get('view.datepicker.format') }}" data-trigger="#show-datepicker-end" onchange="executeSearch()">
					</div>
				</div>

				<div class="clearfix col-md-12 column">
					<label class="label-filter">@lang('misc.buffer')</label>
					<div class="input select rating-underline">
						<select id="spatialFilter">
							<option value="" selected="selected"></option>
							<option value="5">5</option>
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="200">200</option>
							<option value="500">500</option>
						</select>
					</div>
				</div>

				<div class="form-group clearfix col-md-12 column">
					<label class="label-filter">@lang('misc.rateHigh')</label>
					<div class="input select rating-stars">
						<select id="ratingFilter">
							<option value="" selected="selected"></option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
				</div>

			</div>

		</div>
	</form>
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="geodataHeader">
			<h4 class="panel-title">
				<a data-toggle="collapse" href="#showGeodata" aria-expanded="true" aria-controls="showGeodata">@lang('misc.geodata')</a>
				<span class="geodata-progress"></span>
				<button type="button" onclick="saveSearch()" id="mapFilterShare" class="btn btn-default btn-xs pull-right">
					<span class="glyphicon glyphicon-share-alt"></span>
					@lang('misc.share')
				</button>
			</h4>
		</div>
		<ul id="showGeodata" class="list-group collapse in" role="tabpanel" aria-labelledby="geodataHeader">
		</ul>
	</div>
</div>

<!-- For barRating-plugin; loaded in header, otherwise it doesnt works -->
<script type="text/javascript" src="/js/plugins/barRating/jquery.barrating.min.js"></script>

<!-- For the datePicker-plugin -->
<script type="text/javascript" src="/js/plugins/datePicker/datepicker.min.js"></script>