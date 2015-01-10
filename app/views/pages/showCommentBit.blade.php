<% _.each(data, function(row) { %>
	<a class="list-group-item"><%= _.escape(row.metadata.title) %>
	<span class="badge"><%= row.comments %></span></a>
<% }); %>
<% if (_.isEmpty(data)) { %>
	<span class="list-group-item">Es entsprechen leider keine Daten der Suchanfrage.</span>
<% } %>